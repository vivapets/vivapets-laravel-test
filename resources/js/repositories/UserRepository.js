import Client from '../client'

const endpoint = '/users';

export default {
    get() {
        return Client.get(`${endpoint}`);
    },
    getUser() {
        return Client.get(`user`);
    },
    login(payload) {
        return Client.post('login', payload);
    },
    animals(id) {
        return Client.get(`${endpoint}/${id}/animals`);
    },
    ban(id) {
        return Client.get(`${endpoint}/${id}/ban`);
    },
    create(payload) {
        return Client.post(`signup`, payload);
    },
    update(payload, id) {
        return Client.put(`${endpoint}/${id}`, payload);
    },
    delete(id) {
        return Client.delete(`${endpoint}/${id}`)
    }
};