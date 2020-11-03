import Client from '../client'

const endpoint = '/animals';

export default {
    get() {
        return Client.get(`${endpoint}`);
    },
    getAnimal(id) {
        return Client.get(`${endpoint}/${id}`);
    },
    create(payload) {
        return Client.post(`${endpoint}`, payload, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    },
    update(payload, id) {
        return Client.post(`${endpoint}/${id}`, payload, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    },
    delete(id) {
        return Client.delete(`${endpoint}/${id}`)
    }
};