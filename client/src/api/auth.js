import Cookies from 'js-cookie';

const TOKEN_NAME = 'c_t';

export function setToken(token, remember) {
  Cookies.set(TOKEN_NAME, token, remember ? { expires: 30 } : {});
}

export function getToken() {
  return Cookies.get(TOKEN_NAME);
}

export function deleteToken() {
  Cookies.remove(TOKEN_NAME);
}
