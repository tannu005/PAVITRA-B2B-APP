import re
with open(r"database\seeds.sql", "r", encoding="utf-8") as f:
    sql = f.read()

tables = re.findall(r"INSERT INTO `([^`]+)`", sql)
unique_tables = list(dict.fromkeys(tables))
print("Tables to truncate:")
for t in unique_tables:
    print(t)
