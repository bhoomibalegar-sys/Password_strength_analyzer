def generate_wordlist(name, dob, pet, company):
    words = []

    base_words = [name, dob, pet, company]

    for word in base_words:
        words.append(word)
        words.append(word.lower())
        words.append(word.upper())
        words.append(word + "123")
        words.append(word + "@123")

    for w1 in base_words:
        for w2 in base_words:
            if w1 != w2:
                words.append(w1 + w2)
                words.append(w1 + "@" + w2)
                words.append(w1 + "123" + w2)

    with open("wordlist.txt", "w") as f:
        for word in set(words):
            f.write(word + "\n")

    print("Wordlist generated successfully!")
