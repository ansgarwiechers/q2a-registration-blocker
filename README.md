# Q2A Registration Blocker

Blocks registration for provided usernames and email domains.

This plugin was originally created by [Amiya Sahu][1].

## Features

* Block some user names from being registerd on the site (e.g. xxx, owner, spammer, virus, ...).
* Block undesired email domains (e.g. example.org, foo.example.com, ...) and/or all of their subdomains (e.g. .example.org, .foo.example.com, ...). Note that .foo.example.com (with a leading dot) blocks all subdomains of foo.example.com (like bar.foo.example.com and some.other.sub.foo.example.com), but not foo.example.com itself, whereas foo.example.com (without a leading dot) blocks only the domain itself, but none of its subdomains.
  Note that this list is limited to 12000 characters. If you're hitting that limit (which I did) you may want to consider using a URI (DNS) blacklist (see below) for regular domain blocking and leave only subdomain blocking entries in this list.
* Domain blocking can be configured for either blacklist mode (allow all domains/subdomains except the ones listed) or whitelist mode (allow only listed domains/subdomains). Default is blacklist mode.
* Block undesired email addresses by regular expression match (e.g. Gmail addresses with more than 3 dots in their localpart: `(\..*){4,}@gmail\.com$`).
* Block undesired email addresses by URI blacklist lookup (e.g. black.uribl.com). If you're familiar with operating a DNS server I recommend running your own URI blacklist. If you're using a third party service it's recommended to have the local DNS resolver on your Q2A server cache lookup results, so that the blacklist service doesn't get flooded.
* Block registration from undesired client IP addresses by IP blacklist lookup (e.g. bl.blocklist.de). If you're familiar with operating a DNS server I recommend running your own blacklist. If you're using a third party service it's recommended to have the local DNS resolver on your Q2A server cache lookup results, so that the blacklist service doesn't get flooded.
* Prevent users from changing their email address.
* prevent users from changing their username.

## About Question2Answer

Question2Answer is a free and open source platform for Q&A sites. For more information, visit:

http://www.question2answer.org/

[1]: https://github.com/amiyasahu
