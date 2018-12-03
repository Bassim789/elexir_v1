export default class {
  static get_parse(name, cookies){
    if(cookies === undefined) return false
    const nameEQ = name + "="
    const ca = cookies.split(';')
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return false;
  }
  static get(name){
    const nameEQ = name + "="
    const ca = document.cookie.split(';')
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return false;
  }
  static set(name, value, days) {
    let expires = ''
    if (days) {
      let date = new Date()
      date.setTime(date.getTime() + (days*24*60*60*1000))
      expires = "; expires=" + date.toUTCString()
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/"
  }
  static get_token(context){
    if(process.client) return this.get('cookie_token')
    return this.get_parse('cookie_token', context.req.headers.cookie)
  }
}