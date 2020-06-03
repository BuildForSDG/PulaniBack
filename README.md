A financial data management system for low-level entrepreneurs.

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/0b010d5829cf4f8889ac6a34b584c53a)](https://app.codacy.com/gh/BuildForSDG/PulaniBack?utm_source=github.com&utm_medium=referral&utm_content=BuildForSDG/PulaniBack&utm_campaign=Badge_Grade_Dashboard)
[![Codacy Badge](https://img.shields.io/badge/Code%20Quality-D-red)](https://img.shields.io/badge/Code%20Quality-D-red)

## About

Owing to minimal job creation, many people living in poverty have resorted to low-level entrepreneurship – selling g/nuts, riding a boda or even selling chapati.
Others have even “professionalized” their skills – like tailors, mechanics, builders.

That said, the key to lift them out of poverty therefore lies within access to finances. If this is unlocked, there can be business growth and a multiplier effect of job creation.

Despite the numerous efforts to drive financial inclusion, these groups are still out in the “cold”. 


## Why

Pulani App helps reduce poverty by increasing the credit-worthiness of small business owners to financial institutions.

Why? There is an acute lack of financial information from these groups. Think about it. Any lender needs to know that you can pay back the loan, right?

We believe that with availability of financial data, it would increase access to finance for these groups by 50%.

## Usage
To use Pulani App, simply visit `https://pulani2.herokuapp.com`, register and fill required information.


## Setup

- Clone the repostiry `https://github.com/Nataanthoni/PulaniBack.git` to your local directory.
 - `cd to your-folder-name`
 - Make sure your `.env` file is visible.
 - Check and confirm the APP_KEY inside `.env` file
 - Create MySQL `database` with `dbname` as in `.env` 
 - Run `composer upadate`
 - Migrate database by running `php artisan migrate`
 - Seed the database with provided data using `php artisan db:seed`
 - Run `php artisan serve` to run your application on `localhost:8000`

#### Hints

- Test: `composer run test`
- Install dependencies: `composer install <dep name>`
- Lint: `composer run php-cs-fixer`

## Authors

Pulani BackBack came to life through passionate and highly committed developers;
- Stephen Katende - TTL of the project team Github: `https://github.com/Nataanthoni`
- Emmanuel Weele - TTL of the project team Github: `https://github.com/Nataanthoni`
- Anthony Nata - TTL of the project team Github: `https://github.com/Nataanthoni`
- Samuel Okellogum - Backend developer of the project team. Github: `https://github.com/SamuelOkellogum`

## Contributing
If this project sounds interesting to you and you'd like to contribute, thank you!
First, you can send a mail to buildforsdg@andela.com to indicate your interest, why you'd like to support and what forms of support you can bring to the table, but here are areas we think we'd need the most help in this project :
1.  area one (e.g this app is about human trafficking and you need feedback on your roadmap and feature list from the private sector / NGOs)
2.  area two (e.g you want people to opt-in and try using your staging app at staging.project-name.com and report any bugs via a form)
3.  area three (e.g here is the zoom link to our end-of sprint webinar, join and provide feedback as a stakeholder if you can)

## Acknowledgements

Did you use someone else’s code?
Do you want to thank someone explicitly?
Did someone’s blog post spark off a wonderful idea or give you a solution to nagging problem?

It's powerful to always give credit.

## LICENSE
MIT
