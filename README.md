# Vivapets Laravel Interview Test

## Introduction

The purpose of this is repository is meant to be a start point for an interviewee to be able to boot up the code and solve the problem.
We'll be assessing the following topics in your code:

- Design Patterns
- PHP-FIG's PSR guidelines
- Database modelling
- Object Oriented Programming principles
- Frontend code
- Caching

We'll not assess any graphical design skills on frontend, as this test is intended to test your logical reasoning, best practices and coding skills.

### System Requirements

- Unix OS
- Port `80` available
- Docker Engine
- Docker-compose
- `make` command installed
- `git` installed

### Installation

1. Clone this repository locally
2. Copy `.env.example` to `.env`
3. Run `make setup`
4. Run `make up`

You can run `make bash` to enter the container's bash and execute commands inside the container.
When finished, run `make down` to stop all containers.

## The Test

This repository has the basic installation of a Laravel project at version 7.* with `laravel/ui`.

### Instructions
- Fork this repository to your GitHub account
- Complete the tasks given, paying attention to all requirements
- Once completed, create a Pull Request to this repository

### Project

- This project must implement user authentication and registration using Laravel's Auth.
- There will be two different types of users: `Admin` and `Regular User`
- Initial `Admin` account must be created via Database Seeding

As a `Regular User`, I must be able to register an account with my `email`, `name` and `password`.
As a `Regular User`, when I'm logged in, I must be able to:
1. See a list of all my dogs with their respective photos;
2. Add a new dog, with the option to upload his/her `photo`, `name`, `age`, and select a `breed` from a dropdown list;
3. Edit and update all data from my dogs
4. Delete any dog

As an `Admin`, I must be able to login to an admin dashboard.
As an `Admin`, in my dashboard I must be able to:
1. Have a page to list all registered users with their respective `names` and `emails`;
2. Block users from logging in (Ban them from their accounts);
3. Click on any user in the list and be redirected to a page with a list of his dogs with the option to delete any of them (No need to edit dogs, only delete);
4. Have a page to list all available dog breeds;
5. Add a new dog breed with a `breed_name`;
6. Edit any dog breed;
7. Delete any dog breed;

### Requirements

- Must use Laravel migrations to setup the tables in database
- Endpoint responses must be simple JSON objects
- Implement Service and Repository layers
- Validate all input with Laravel's Request abstraction
- Data fetched must be cached
- Must use VueJS and SCSS to build the frontend
- Frontend must consume data from back-end's responses

-------------------

Good luck! :D
