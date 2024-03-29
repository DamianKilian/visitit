const langAttr = document.getElementsByTagName("html")[0].getAttribute("lang");
// const langAttr = 'pl';
const lang = {
    pl: {
        Edit: "Edytuj",
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
        "Place title": "Tytuł miejsca",
        "File type must be one of the following: ":
            "Typ pliku musi być jednym z następujących: ",
        "Max file size is: ": "Maksymalny rozmiar pliku to: ",
        See: "Zobacz",
    },
};

exports.__ = function (str) {
    if (_.has(lang, [langAttr, str])) {
        return lang[langAttr][str];
    }
    return str;
};
