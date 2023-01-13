const langAttr = document.getElementsByTagName("html")[0].getAttribute("lang");
// const langAttr = 'pl';
const lang = {
    pl: {
        "Email address": "Adres email",
        "Incorrect email address": "Nieprawidłowy adres email",
        Password: "Hasło",
        "Confirm password": "Potwierdź hasło",
        "Password confirmation doesn't match": "Potwierdzenie hasła nie pasuje",
        "Password must have at least 8 characters":
            "Hasło musi mieć co najmniej 8 znaków",
        Title: "Tytuł",
        "Enable place?": "Aktywować miejsce?",
        "Disable place?": "Deaktywować miejsce?",
        "Delete permanently place?": "Usunąć na stałe miejsce?",
        "Delete permanently": "Usuń na stałe",

        
    },
};

exports.__ = function (str) {
    if (_.has(lang, [langAttr, str])) {
        return lang[langAttr][str];
    }
    return str;
};
