import Client from '../client'

const endpoint = '/animals_types';

export default {
    get() {
        return Client.get(`${endpoint}`);
    },
    getType(id) {
        return Client.get(`${endpoint}/${id}`);
    },
    create(payload) {
        return Client.post(`${endpoint}`, payload);
    },
    update(payload, id) {
        return Client.put(`${endpoint}/${id}`, payload);
    },
    delete(id) {
        return Client.delete(`${endpoint}/${id}`)
    }
};