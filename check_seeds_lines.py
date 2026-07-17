with open(r"database\seeds.sql", "r", encoding="utf-8") as f:
    lines = f.readlines()
    for i in range(10):
        print(repr(lines[i]))
