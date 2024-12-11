import sqlite3

DATABASE = 'customers.db'

def add_customer(name):
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    cursor.execute("INSERT INTO customers (name) VALUES (?)", (name,))
    connection.commit()
    connection.close()

def get_all_customers():
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM customers")
    customers = cursor.fetchall()
    connection.close()
    return [{'id': row[0], 'name': row[1]} for row in customers]

def update_customer(customer_id, new_name):
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    cursor.execute("UPDATE customers SET name = ? WHERE id = ?", (new_name, customer_id))
    connection.commit()
    connection.close()

def delete_customer(customer_id):
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    cursor.execute("DELETE FROM customers WHERE ID = ?", (customer_id))
    connection.commit()
    connection.close()