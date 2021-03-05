class AppStorage {

    storeToken (token) {
        localStorage.setItem('token', token);
    }

    storeUser (user) {
        localStorage.setItem('user', user);
    }

    store (token, user) {
        this.storeToken(token);
        this.storeUser(user);
    }

    clear () {
        localStorage.removeItem('token', token);
        localStorage.removeItem('user', user);
    }

    getToken () {
        localStorage.getToken('token');
    }

    getUser () {
        localStorage.getToken('user');
    }
}

export default AppStorage = new AppStorage();