import sqlite3

DATABASE = 'customers.db'

def add_customer(name, birthdate):
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    cursor.execute("INSERT INTO customers (name, birthdate) VALUES (?, ?)", (name, birthdate))
    connection.commit()
    connection.close()

def get_all_customers():
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM customers")
    customers = cursor.fetchall()
    connection.close()
    return [{'id': row[0], 'name': row[1], 'birthdate': row[2]} for row in customers]

def update_customer(customer_id, new_name, new_birthdate):
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    
    query = "UPDATE customers SET "
    params = []

    if new_name:
        query += "name = ?, "
        params.append(new_name)

    if new_birthdate:
        query += "birthdate = ?, "
        params.append(new_birthdate)

    query = query.rstrip(", ")

    query += " WHERE id = ?"
    params.append(customer_id)
    
    if params:
        cursor.execute(query, params)
        connection.commit()

    connection.close()

def delete_customer(customer_id):
    connection = sqlite3.connect(DATABASE)
    cursor = connection.cursor()
    cursor.execute("DELETE FROM customers WHERE id = ?", (customer_id,))
    connection.commit()
    connection.close()