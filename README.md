# Q2A Registration Blocker

Blocks registration for provided usernames and email domains.

This plugin was originally created by [Amiya Sahu][1].

## Features

* Block some user names from being registerd on the site (e.g. xxx, owner, spammer, virus, ...).
* Block undesired email domains (e.g. example.org, foo.example.com, ...) and/or all of their subdomains (e.g. .example.org, .foo.example.com, ...). Note that .foo.example.com (with a leading dot) blocks all subdomains of foo.example.com (like bar.foo.example.com and some.other.sub.foo.example.com), but not foo.example.com itself, whereas foo.example.com (without a leading dot) blocks only the domain itself, but none of its subdomains.
* Domain blocking can be configured for either blacklist mode (allow all domains/subdomains except the ones listed) or whitelist mode (allow only listed domains/subdomains). Default is blacklist mode.
* Block undesired email addresses by regular expression match (e.g. Gmail addresses with more than 3 dots in their localpart: `(\..*){4,}@gmail\.com$`).
* Prevent users from changing their email address.
* prevent users from changing their username.

## About Question2Answer

Question2Answer is a free and open source platform for Q&A sites. For more information, visit:

http://www.question2answer.org/

[1]: https://github.com/amiyasahu
