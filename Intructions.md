
Your task will be based on the following details:

1. The setup must be Laravel 8.0, Mysql (Or MariaDB), Nginx.
2. Create a table inside MySQL, call `vouchers`
- The table consists of columns below.
- id
- voucher_code
- status - Values ('Available', 'Claimed', 'Expired')
- expiry_date
- created_at
- updated_at

3. Create A function (Not Seeder) to generate 3,000,000 (3 Millions) records of voucher codes in less than 10 minutes. Store all all it in database.
- The voucher code must be Unique, Case Sensitive, Alpha-Numeric. (No Symbol allowed)
- The voucher code must be scrambled, non-sequence, and public users not able to guess the code patterns easily.
- For eg: x9aLd3, 0LPxYi, aXd91S, pLax78, 091XsD
- Max length = 6
- For the Expiry Date column, generate random expiry date between previous and next 3 days, Mark the status column to "Expired" if the expiry date is past.

4. An API to run the function in step 3, and returning status and the total processing time.
5. An API to return One (1), Available, Unclaimed, Voucher code.
6. An API to Claim the voucher with the voucher code
- for eg: http://abc.local/claim?code=pLax78
- Mark the record to "Claimed" if the voucher hasn't expired.
7. An API to provide stats in Json Format.
- Numbers of Available, Claimed and Expired
- Numbers of Expiring in 6, 12, 24 hours.
8. Wrap all the services into a docker. (Can be both Dockerfile or docker-compose).
- The architecture must be on x64.
- The Docker size must be limited to 1 Core CPU and 2GB of RAM.
- Upload the code into any git repo services (Github / Bitbucket)
- The docker must be able to setup and start with just docker-compose up -d

Important Note:
- Code the whole task strictly in Laravel architecture instead of pure PHP.
- Your deadline will be by 17th October 2022 (Monday), 11:59pm.
- Any questions/struggles feel free to contact me via my phone number.
- Please reply in email once you have received this email.