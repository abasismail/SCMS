import mysql.connector

# Establish a connection to the database
cnx = mysql.connector.connect(user='root', password='',
                              host='localhost', database='se')

# Create a cursor
cursor = cnx.cursor()

# Prompt the user to enter a search term
search_term = input("Enter a search term: ")

# Query to search for a supplier with a name similar to the search term
supplier_query = ("SELECT * FROM supplier WHERE supplier_name LIKE %s")

# Query to search for an item with a name similar to the search term
item_query = ("SELECT * FROM supplier_catalog_item WHERE name LIKE %s")

# Add wildcard characters to the search term
wildcard_search_term = "%" + search_term + "%"

# Execute the supplier query
cursor.execute(supplier_query, (wildcard_search_term,))

# Fetch the results
supplier_results = cursor.fetchall()

# Execute the item query
cursor.execute(item_query, (wildcard_search_term,))

# Fetch the results
item_results = cursor.fetchall()

# Print the results
if supplier_results:
    print("Supplier results:")
    for supplier in supplier_results:
        print(supplier)
else:
    print("No supplier results found.")

if item_results:
    print("Item results:")
    for item in item_results:
        print(item)
else:
    print("No item results found.")

# Close the cursor and connection to the database
cursor.close()
cnx.close()