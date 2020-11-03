# Vivapets Laravel Interview Test

## Introduction

This is my solution for the proposed test. Features:

- API with OAuth 2.0
- Alows the app to grown for any king of animal (not just dogs)
- User types are dynamic
- Animals Types are dynamic
- The menu is also dynamic according to the user type


## Admin User

The default admin users, created in the seed is `test@vivapets.com` and the password is `password`

## Know issues

- Animals breeds should belong to an animal type.
- TODO: Implement Vuex store states.
- TODO: Implement front-end validation
- TODO: Menu must be dynamic with a service
- TODO: Unit tests

### Installation

1. Clone this repository locally
2. Copy `.env.example` to `.env`
3. Run `make setup`
4. Run `make up`
5. Run `make bash && php artisan storage:link`
