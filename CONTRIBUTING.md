# Contributing to Resume to Website

## Getting the project set up locally

There are a number of Docker Compose examples that are suitable for a wide variety of deployment strategies depending on your use-case. All the examples can be found in the `tools/compose` folder.

To run the development environment of the application locally on your computer, please follow these steps:

#### Requirements

- PHP 8.1 or higher
- Node.js 20 or higher (with npm)

### 1. Fork and Clone the Repository

```sh
git clone https://github.com/{your-github-username}/resumetowebsite.git
cd resumetowebsite
```

### 2. Install dependencies

```sh
npm install
```

### 3. Copy .env.example to .env

```sh
cp .env.example .env
```

Please have a brief look over the environment variables and change them if necessary, for example, change the ports if you have a conflicting service running on your machine already.

It should take just under half a minute for all the services to be booted up correctly. You can check the status of all services by running `docker compose -p resumetowebsite ps`

### 4. Download Packages

```sh
npm i
composer i 
```

### 5. Run App

```sh
composer run dev 
```

If everything went well, the frontend should be running on `http://localhost:8000`.

---

## Pushing changes to the app

Firstly, ensure that there is a GitHub Issue created for the feature or bugfix you are working on. If it does not exist, create an issue and assign it to yourself.

Once you are happy with the changes you've made locally, commit it to your repository. Note that the project makes use of Conventional Commits, so commit messages would have to be in a specific format for it to be accepted. For example, a commit message to fix the translation on the homepage could look like:

```
git commit -m "fix(homepage): fix typo on homepage in the faq section"
```

It helps to be as descriptive as possible in commit messages so that users can be aware of the changes made by you.

Finally, create a pull request to merge the changes on your forked repository to the original repository hosted on AmruthPillai/resumetowebsite. I can take a look at the changes you've made when I have the time and have it merged onto the app.
