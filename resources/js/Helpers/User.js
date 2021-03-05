import AppStorage from './AppStorage'
import Token from './Token'

class User {

    responseAfterLogin(response) {
        const token = response.data.access_token;
        const name  = response.data.name;

        if (Token.isValid(token)) {
            AppStorage.store(token, name);
        }
    }

    hasToken() {
        const storeToken = localStorage.getItem('token');
        if (storeToken) {
            return Token.isValid(storeToken) ? true : false
        }
        return false
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
        this.$router.push({ name: '/' });
    }

    name() {
        if (this.loggedIn()) {
            return localStorage.getItem('user');
        }
    }

    id() {
        if (this.loggedIn) {
            const payload = Token.payload(localStorage.getItem('token'));
            return payload.sub
        }
        return false
    }
}

export default User = new User();