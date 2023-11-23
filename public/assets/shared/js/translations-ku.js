const currentLocale = 'ku';
const dataLocale = 'ku';
const allLangs = [];
window.__ = function(name, parameters = null) {
  let lang = allLangs[name];
  if (parameters) {
     for (const param of Object.keys(parameters)) {
        lang = lang.replace(new RegExp(':'+param, 'g'), parameters[param]);
     }
     return lang;
  } else {
     return lang;
  }
}