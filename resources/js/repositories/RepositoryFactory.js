import UserRepository from './UserRepository';
import AnimalRepository from './AnimalRepository';
import BreedRepository from './BreedRepository';
import TypeRepository from './TypeRepository';

const repositories = {
    'users': UserRepository,
    'animals': AnimalRepository,
    'breeds': BreedRepository, 
    'types': TypeRepository
}

export default {
    get: name => repositories[name]
};