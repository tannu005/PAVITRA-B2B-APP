<?php
namespace Core;

class Cache {
    protected bool $useRedis = false;
    protected $redis = null;
    protected string $cachePath;

    public function __construct() {
        $this->cachePath = dirname(__DIR__) . '/storage/cache/';
        
     
        if (class_exists('Predis\Client')) {
            try {
                $this->redis = new \Predis\Client([
                    'scheme' => 'tcp',
                    'host'   => '127.0.0.1',
                    'port'   => 6379,
                ]);
                $this->useRedis = true;
            } catch (\Throwable $e) {
                $this->useRedis = false;
            }
        } elseif (class_exists('Redis')) {
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
                return $data ? unserialize($data) : null;
            } catch (\Throwable $e) {}
        }
        
        $filePath = $this->cachePath . $cacheKey . '.cache';
        if (!file_exists($filePath)) {
            return null;
        }
        $raw = file_get_contents($filePath);
        if (!$raw) return null;
        
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
                $this->redis->setex($cacheKey, $ttl, serialize($value));
                return true;
            } catch (\Throwable $e) {}
        }
        
        $filePath = $this->cachePath . $cacheKey . '.cache';
        $data = [
            'expires' => time() + $ttl,
            'value' => $value
        ];
        return file_put_contents($filePath, serialize($data)) !== false;
    }

    public function delete(string $key): bool {
        $cacheKey = 'pavitra_cache_' . md5($key);
        if ($this->useRedis && $this->redis) {
            try {
                $this->redis->del($cacheKey);
                return true;
            } catch (\Throwable $e) {}
        }
        $filePath = $this->cachePath . $cacheKey . '.cache';
        if (file_exists($filePath)) {
            return @unlink($filePath);
        }
        return true;
    }

    public function clear(): bool {
        if ($this->useRedis && $this->redis) {
            try {
                $this->redis->flushdb();
                return true;
            } catch (\Throwable $e) {}
        }
        $files = glob($this->cachePath . '*.cache');
        foreach ($files as $file) {
            if (is_file($file)) {
                @unlink($file);
            }
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
}
