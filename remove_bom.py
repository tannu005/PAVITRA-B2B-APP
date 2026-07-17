with open(r"database\seeds.sql", "rb") as f:
    data = f.read()
if data.startswith(b"\xef\xbb\xbf"):
    data = data[3:]
with open(r"database\seeds.sql", "wb") as f:
    f.write(data)
