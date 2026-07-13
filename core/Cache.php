<?php
namespace Core;
class Cache {
    protected bool $useRedis = false;
    protected ?\Redis $redis = null;
    protected string $cachePath;
    public function __construct() {
        $this->cachePath = dirname(__DIR__) . '/storage/cache/';
        if (class_exists('Redis')) {
            try {
                $this->redis = new \Redis();
                if ($this->redis->connect('127.0.0.1', 6379, 1.0)) {
                    $this->useRedis = true;
                }
            } catch (\Throwable $e) {
                $this->useRedis = false;
            }
        }
        if (!$this->useRedis && !is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0777, true);
        }
    }
    public function get(string $key) {
        $cacheKey = 'pavitra_cache_' . md5($key);
        if ($this->useRedis && $this->redis) {
            try {
                $data = $this->redis->get($cacheKey);
                return $data !== false ? unserialize($data) : null;
            } catch (\Throwable $e) {
            }
        }
        $filePath = $this->cachePath . $cacheKey . '.cache';
        if (!file_exists($filePath)) {
            return null;
        }
        $raw = file_get_contents($filePath);
        if (!$raw) {
            return null;
        }
        $cached = unserialize($raw);
        if (!$cached || !is_array($cached) || !isset($cached['expires']) || !isset($cached['value'])) {
            return null;
        }
        if (time() > $cached['expires']) {
            @unlink($filePath);
            return null;
        }
        return $cached['value'];
    }
    public function set(string $key, $value, int $ttl = 300): bool {
        $cacheKey = 'pavitra_cache_' . md5($key);
        if ($this->useRedis && $this->redis) {
            try {
                return $this->redis->setex($cacheKey, $ttl, serialize($value));
            } catch (\Throwable $e) {
            }
        }
        $filePath = $this->cachePath . $cacheKey . '.cache';
        $data = [
            'expires' => time() + $ttl,
            'value' => $value
        ];
        return file_put_contents($filePath, serialize($data), LOCK_EX) !== false;
    }
    public function delete(string $key): bool {
        $cacheKey = 'pavitra_cache_' . md5($key);
        if ($this->useRedis && $this->redis) {
            try {
                return (bool) $this->redis->del($cacheKey);
            } catch (\Throwable $e) {
            }
        }
        $filePath = $this->cachePath . $cacheKey . '.cache';
        if (file_exists($filePath)) {
            return @unlink($filePath);
        }
        return true;
    }
    public function remember(string $key, int $ttl, callable $callback) {
        $value = $this->get($key);
        if ($value !== null) {
            return $value;
        }
        $value = $callback();
        $this->set($key, $value, $ttl);
        return $value;
    }
    public function clear(): void {
        if ($this->useRedis && $this->redis) {
            try {
                $keys = $this->redis->keys('pavitra_cache_*');
                if (!empty($keys)) {
                    $this->redis->del($keys);
                }
                return;
            } catch (\Throwable $e) {
            }
        }
        $files = glob($this->cachePath . '*.cache');
        foreach ($files as $file) {
            if (is_file($file)) {
                @unlink($file);
            }
        }
    }
}
