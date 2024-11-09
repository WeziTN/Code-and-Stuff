import pandas as pd
import mysql.connector

# Load Excel data
file_path = "Book1.xlsx"
df = pd.read_excel(file_path)

# Connect to the database
db_connection = mysql.connector.connect(
    host='localhost',
    user='root',
    password='',
    database='wina_bdb'
)
cursor = db_connection.cursor()

# Insert data into the database
for _, row in df.iterrows():
    cursor.execute("""
        INSERT INTO transactions (transaction_id, mobile_booth, location, service, revenue_per_kwacha, transaction_amount)
        VALUES (%s, %s, %s, %s, %s, %s)
    """, (row['TranactionID'], row['Mobile Booth'], row['Location'], row['Service'], row['Revenue per Kwanch'], row['Transction Amount']))

db_connection.commit()
cursor.close()
db_connection.close()
