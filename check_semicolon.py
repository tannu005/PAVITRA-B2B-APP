with open(r"database\seeds.sql", "r", encoding="utf-8") as f:
    data = f.read()
print("Total characters:", len(data))
print("Total semicolons:", data.count(';'))
