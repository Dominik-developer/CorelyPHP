# Security Policy

‼️ Security suggestions should be treated as invalid, not as vulnerabilities.

## Security Policy

* **Latest Releases:** The newest release, currently version v1.0.0, is the only version receiving active security updates. We strongly recommend using the latest version whenever possible.

* **Review Changelog for Updates:** For minor updates or changes, please refer to the changelog to understand what has been updated or fixed.

* **No Backports:** Security fixes are applied exclusively to the latest version. Older versions will not receive retroactive patches for vulnerabilities.

* **Security Risks of Unsupported Versions:** Using unsupported versions exposes you to known and unknown vulnerabilities, as they are no longer maintained or updated.

* **Update Regularly:** Keeping your software up to date is essential to ensure your system remains secure.

## Supported Versions

* All safe and supported versions of our software are marked with a ✅.  
* It is highly recommended to use only these versions, as they contain the latest security fixes and improvements. Older, unsupported versions should be avoided, as they may contain vulnerabilities that will not be addressed retroactively.  
* New versions that do not introduce security changes will not affect the support status of previous versions.

| Version       | Supported          |
| ------------- | ------------------ |
| pre-release   | :negative_squared_cross_mark:  |
| v0.1.0-beta   | :white_check_mark: |
| v1.0.0        | :white_check_mark: |

## Reporting a Vulnerability

‼️ Please report only one vulnerability at a time, unless it is genuinely connected to another issue.

To report a vulnerability:

* Create an issue.
* In the title, write "Vulnerability" and specify which part it affects (admin/user/other) and how serious it is.
* Tag me in the issue.
* Add the "Vulnerability" label, or a "Bug" label, or an "Invalid" label if it’s not valid.
* Write a detailed description:
  * A short summary of the vulnerability.
  * Which part of the repository is affected.
  * In which version the vulnerability occurs.
  * How serious the vulnerability is.
  * What type of vulnerability it is (e.g., XSS, SQL injection, etc.).
  * How you found the issue and how it happened.
* If you know how to fix the issue, feel free to propose a solution:
  * Propose a solution in the issue or via a pull request.
  * If submitting a pull request, please note in the PR description that it fixes this specific issue.
* Publish the issue and you’re done!
* I may comment on your issue, so please turn on notifications to stay updated.

Thank you for reporting issues and helping make the project more secure!  
— Main developer: Dominik-developer
