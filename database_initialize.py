import sqlite3

def create_database():
    connection = sqlite3.connect("customers.db")

    cursor = connection.cursor()

    cursor.execute('''
        CREATE TABLE IF NOT EXISTS customers (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL
        )
    ''')

    connection.commit
    connection.close

if __name__ == "__main__":
    create_database()
    print("Database and customers table created.")
