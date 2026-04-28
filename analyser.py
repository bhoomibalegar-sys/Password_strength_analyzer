import re

def check_strength(password):
    score = 0
    remarks = []

    # Length check
    if len(password) >= 8:
        score += 1
    else:
        remarks.append("Password should be at least 8 characters long")

    # Uppercase check
    if re.search(r"[A-Z]", password):
        score += 1
    else:
        remarks.append("Add uppercase letters")

    # Lowercase check
    if re.search(r"[a-z]", password):
        score += 1
    else:
        remarks.append("Add lowercase letters")

    # Numbers check
    if re.search(r"\d", password):
        score += 1
    else:
        remarks.append("Include numbers")

    # Special characters
    if re.search(r"[!@#$%^&*(),.?\":{}|<>]", password):
        score += 1
    else:
        remarks.append("Add special characters")

    # Strength level
    if score <= 2:
        strength = "Weak"
    elif score == 3 or score == 4:
        strength = "Moderate"
    else:
        strength = "Strong"

    return strength, remarks
