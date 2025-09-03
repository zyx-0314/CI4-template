# Repository and Infrastructures

## Repository Structure

- Monorepo Structure: This uses a single repo for codes and deploy each in respective folders
- Basic Repository Requirements:
  - readme.md (modify accordingly)
        - [ ] Title
        - [ ] Description
        - [ ] Update Overview
        - [ ] Update Key Components
        - [ ] Update Technology
        - [ ] Update Resources
    - .gitignore (just copy but you can revise)
    - license (just copy)
- Folder Structure
  - backend : folder which houses the ci4 or backend infrastracture
  - docs : folder which houses the documentations, checklist and reports
  - frontend : folder which houses the react/vue or frontend infrastracture

## CI4
- [ ] Initialize CI4
```bash
composer create-project codeigniter4/appstarter backend
```
- [ ] Update `php.ini`
```text
<!-- remove the `;` from the front of the following ext -->
extension=intl
```
- [ ] Install CI4 dependencies
```bash
composer install
```
- [ ] deleting `.git` of backend
  - [ ] open the file directory
  - [ ] switch hidden files to on
  - [ ] then delete `.git`

## Docker Setup
- [ ] Just use the format its set already, changing port if it has an issue

## CI4 Env Setup
- Check compose.yaml
- [ ] Make sure `.env` data are matched withsql environments

### Notes:
- port: sets what port it will appear
- environment: sets the initial datas and serves as the credentials

## Test
There is test commands added for testing Ci and Database.
To test use the following commands
- [ ] Make sure composer is working.
```bash
docker compose exec php composer dump-autoload
```
  - Expected result should be something similar to this
  ```cmd
  Generating optimized autoload files
  Generated optimized autoload files containing 2460 classes
  ```
- [ ] Check if the both technology are working
```bash
docker compose exec php php spark health:check
# or
docker compose exec php composer health
```
  - Expected result
  ```cmd
  CodeIgniter: up (version 4.6.3)
  Database: up (31.72 ms)
  ```
