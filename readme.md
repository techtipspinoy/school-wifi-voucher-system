# WIFI HOTSPOT VOUCHER AUTHENTICATION SYSTEM

I'll create a complete solution that validates school IDs against an allowed list and generates voucher codes. The system will include both frontend and backend components.

## SOLUTION OVERVIEW:
Frontend: HTML/CSS/JS interface for user input and voucher display
Backend: PHP script to validate school IDs and generate vouchers
Security: Simple allowed list stored in a JSON file (in production, use a database)

## IT WORKS
User Interface: Students enter their 8-digit ID in the form

## Validation:
Frontend validates ID format (8 digits)
Backend checks if ID exists in the allowed list

## Voucher Generation:
If valid, generates a 12-character voucher code in XXXX-XXXX-XXXX format
Voucher is displayed with expiration notice

## Security:
Only pre-approved student IDs can generate vouchers
Voucher codes are randomly generated and unique

## Setup Instructions:
Create a new directory for the project
Save all files in the same directory:
index.html
styles.css
script.js
generate_voucher.php
allowed_students.json (will be auto-generated with sample data)

Host on a PHP-enabled server (Apache with PHP module or similar)
To add more students, edit the allowed_students.json file

## SECURITY CONSIDERATIONS

## For Production Use:
Store allowed students in a database instead of JSON file
Implement proper authentication for admin access
Add rate limiting to prevent brute force attacks
Store vouchers in database with expiration timestamps
Use HTTPS to encrypt all communications

## Voucher Security:
Vouchers should be single-use or time-limited
Implement a redemption system to validate vouchers at the hotspot

This solution provides a complete, functional voucher system that can be easily extended for production use with additional security measures.

