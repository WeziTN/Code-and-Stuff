

# -*- coding: utf-8 -*-
"""
Integrated Library System
"""

class Book:
    def __init__(self, ISBN, title, author, genre="General"):
        self.title = title
        self.ISBN = ISBN
        self.author = author
        self.genre = genre
        self.available = True

    def __str__(self):
        status = "Available" if self.available else "Checked Out"
        return f"'{self.title}' by {self.author} (ISBN: {self.ISBN}) - {status}"

class Node:
    def __init__(self, book):
        self.book = book
        self.next = None
        self.prev = None

class CircularDoublyLinkedList:
    def __init__(self):
        self.head = None

    def insert(self, book):
        new_node = Node(book)
        if self.head is None:
            self.head = new_node
            new_node.next = new_node
            new_node.prev = new_node
        else:
            tail = self.head.prev
            tail.next = new_node
            new_node.prev = tail
            new_node.next = self.head
            self.head.prev = new_node

    def delete(self, ISBN):
        if self.head is None:
            return None
        
        current = self.head
        while True:
            if current.book.ISBN == ISBN:
                if current.next == current:  # Only one node
                    self.head = None
                else:
                    current.prev.next = current.next
                    current.next.prev = current.prev
                    if current == self.head:
                        self.head = current.next
                return current.book
            current = current.next
            if current == self.head:
                break
        return None

    def display_all(self):
        if self.head is None:
            print("No books in the library.")
            return
        
        current = self.head
        while True:
            print(current.book)
            current = current.next
            if current == self.head:
                break

class HashTable:
    def __init__(self, size=100):
        self.size = size
        self.table = [[] for _ in range(size)]

    def _hash(self, key):
        return hash(key) % self.size

    def add(self, key, value):
        hash_key = self._hash(key)
        for i, (k, v) in enumerate(self.table[hash_key]):
            if k == key:
                self.table[hash_key][i] = (key, value)
                return
        self.table[hash_key].append((key, value))

    def get(self, key):
        hash_key = self._hash(key)
        for k, v in self.table[hash_key]:
            if k == key:
                return v
        return None

    def remove(self, key):
        hash_key = self._hash(key)
        for i, (k, v) in enumerate(self.table[hash_key]):
            if k == key:
                self.table[hash_key].pop(i)
                return True
        return False

class Transaction:
    def __init__(self, action, book, description):
        self.action = action
        self.book = book
        self.description = description
        self.timestamp = "Now"  # In a real system, this would be datetime.now()

    def __str__(self):
        return f"{self.timestamp}: {self.action} - {self.book.title} ({self.description})"

class Stack:
    def __init__(self, capacity=1000):
        self.capacity = capacity
        self.stack = []

    def push(self, item):
        if len(self.stack) < self.capacity:
            self.stack.insert(0, item)
            return True
        else:
            return False

    def pop(self):
        if self.stack:
            return self.stack.pop(0)
        else:
            return None

    def is_empty(self):
        return len(self.stack) == 0

    def is_full(self):
        return len(self.stack) >= self.capacity

    def peek(self):
        if self.stack:
            return self.stack[0]
        else:
            return None

    def count(self):
        return len(self.stack)

    def display(self):
        for item in self.stack:
            print(item)

class LibrarySystem:
    def __init__(self):
        self.book_list = CircularDoublyLinkedList()
        self.book_index = HashTable()
        self.transaction_history = Stack()

    def add_book(self, ISBN, title, author, genre="General"):
        new_book = Book(ISBN, title, author, genre)
        self.book_list.insert(new_book)
        # Assume the new node is at the tail (head.prev)
        self.book_index.add(ISBN, self.book_list.head.prev)
        self.transaction_history.push(Transaction("insert", new_book, "Added new book"))
        print(f"Book '{title}' added successfully.")

    def check_out_book(self, ISBN):
        node = self.book_index.get(ISBN)
        if node and node.book.available:
            node.book.available = False
            self.transaction_history.push(Transaction("check-out", node.book, "Book checked out"))
            print(f"Book '{node.book.title}' checked out successfully.")
        else:
            print("Book not available or not found.")

    def check_in_book(self, ISBN):
        node = self.book_index.get(ISBN)
        if node and not node.book.available:
            node.book.available = True
            self.transaction_history.push(Transaction("check-in", node.book, "Book checked in"))
            print(f"Book '{node.book.title}' checked in successfully.")
        else:
            print("Book not found or already checked in.")

    def update_book(self, ISBN, title=None, author=None, genre=None):
        node = self.book_index.get(ISBN)
        if node:
            if title:
                node.book.title = title
            if author:
                node.book.author = author
            if genre:
                node.book.genre = genre
            self.transaction_history.push(Transaction("update", node.book, "Updated book metadata"))
            print(f"Book with ISBN {ISBN} updated successfully.")
        else:
            print("Book not found.")

    def remove_book(self, ISBN):
        book = self.book_list.delete(ISBN)
        if book:
            self.book_index.remove(ISBN)
            self.transaction_history.push(Transaction("remove", book, "Removed book from library"))
            print(f"Book '{book.title}' removed successfully.")
        else:
            print("Book not found.")

    def display_books(self):
        print("\nLibrary Book Collection:")
        self.book_list.display_all()

    def display_transactions(self):
        print("\nTransaction History:")
        if self.transaction_history.is_empty():
            print("No transactions recorded.")
        else:
            self.transaction_history.display()

    def search_book(self, ISBN):
        node = self.book_index.get(ISBN)
        if node:
            print("\nBook Found:")
            print(node.book)
        else:
            print("Book not found.")

def main():
    library = LibrarySystem()
    
    while True:
        print("\nLibrary Management System")
        print("1. Add a new book")
        print("2. Check out a book")
        print("3. Check in a book")
        print("4. Update book information")
        print("5. Remove a book")
        print("6. Display all books")
        print("7. Search for a book")
        print("8. View transaction history")
        print("9. Exit")
        
        choice = input("Enter your choice (1-9): ")
        
        if choice == "1":
            ISBN = input("Enter ISBN: ")
            title = input("Enter title: ")
            author = input("Enter author: ")
            genre = input("Enter genre (optional, press Enter to skip): ")
            if genre:
                library.add_book(ISBN, title, author, genre)
            else:
                library.add_book(ISBN, title, author)
        
        elif choice == "2":
            ISBN = input("Enter ISBN of the book to check out: ")
            library.check_out_book(ISBN)
        
        elif choice == "3":
            ISBN = input("Enter ISBN of the book to check in: ")
            library.check_in_book(ISBN)
        
        elif choice == "4":
            ISBN = input("Enter ISBN of the book to update: ")
            title = input("Enter new title (or press Enter to skip): ")
            author = input("Enter new author (or press Enter to skip): ")
            genre = input("Enter new genre (or press Enter to skip): ")
            if not title and not author and not genre:
                print("No updates provided.")
            else:
                library.update_book(ISBN, title if title else None, 
                                  author if author else None, 
                                  genre if genre else None)
        
        elif choice == "5":
            ISBN = input("Enter ISBN of the book to remove: ")
            library.remove_book(ISBN)
        
        elif choice == "6":
            library.display_books()
        
        elif choice == "7":
            ISBN = input("Enter ISBN of the book to search: ")
            library.search_book(ISBN)
        
        elif choice == "8":
            library.display_transactions()
        
        elif choice == "9":
            print("Exiting the Library System. Goodbye!")
            break
        
        else:
            print("Invalid choice. Please enter a number between 1 and 9.")

if __name__ == "__main__":
    main()