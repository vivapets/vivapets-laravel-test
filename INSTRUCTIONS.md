# Vivapets Laravel Interview Test

## Introduction

This is my solution for the proposed test. Features:

- API with OAuth 2.0
- All list support pagination
- Alows the app to grown for any king of animal (not just dogs)
- User types are dynamic
- Animals Types are dynamic
- The menu is also dynamic according to the user type
- Regular Users can:
    - View, create, edit and delete their animals
- Admin users can:
    - View, create, edit and delete breeds
    - View, create, edit and delete types
    - View users and their animals
    - Ban/Unban an user


## Admin User

The default admin users, created in the seed is `test@vivapets.com` and the password is `password`

## Know issues

- Animals breeds should belong to an animal type
- TODO: Refactor menu state to use vuex/states
- TODO: Implement front-end validation
- TODO: Menu must be dynamic with a service
- TODO: Implement pagination in the frontend
- TODO: Unit tests

### Installation

1. Clone this repository locally
2. Copy `.env.example` to `.env`
3. Run `make setup`
4. Run `make up`
5. Run `make bash && php artisan passport:install && php artisan storage:link`
6. Create at least one breed


### Docker issues

When i first cloned the repo, the dockerfile and docker-compose files was not working properly (at least in mac os), so i had to make some changes in order to get the app running. Please, check if those cnages did not break up at your linux dist.