from analyzer import check_strength
from generator import generate_wordlist

def main():
    print("==== Password Tool ====")
    print("1. Check Password Strength")
    print("2. Generate Wordlist")

    choice = input("Enter your choice: ")

    if choice == "1":
        password = input("Enter password: ")
        strength, remarks = check_strength(password)

        print("\nPassword Strength:", strength)
        if remarks:
            print("Suggestions:")
            for r in remarks:
                print("-", r)

    elif choice == "2":
        print("\nEnter details:")
        name = input("Name: ")
        dob = input("DOB: ")
        pet = input("Pet name: ")
        company = input("Company: ")

        generate_wordlist(name, dob, pet, company)

    else:
        print("Invalid choice")

if __name__ == "__main__":
    main()
