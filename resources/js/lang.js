const langAttr = document.getElementsByTagName('html')[0].getAttribute('lang');
// const langAttr = 'pl';
const lang = {
    pl:{
        'Email address': 'Adres email',
        'Incorrect email address': 'Nieprawidłowy adres email',
    }
};

exports.__ = function(str) {
    if(_.has(lang, [langAttr, str])){
        return lang[langAttr][str];
    }
    return str;
}
