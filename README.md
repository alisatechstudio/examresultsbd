# Bangladesh Public Exam Results Portal

Search all public exam results in Bangladesh from one place. This portal helps students, parents, and job seekers quickly find results for major public examinations including PSC, JSC, SSC, HSC, National University, BCS, Diploma, and Teacher Registration.

## Supported Exams

- **PSC** - Primary School Certificate
- **JSC** - Junior School Certificate
- **SSC** - Secondary School Certificate
- **HSC** - Higher Secondary Certificate
- **National University** - Degree, Honours, and professional course results
- **BCS** - Bangladesh Public Service Commission
- **Diploma** - Diploma in Engineering results
- **Teacher Registration** - Teacher Registration Certificate results

## Features

- Quick result search across all major Bangladeshi public exams
- Support for multiple education boards
- Official and trusted result source links
- Mobile responsive design
- Instant redirect to Google search with formatted result query

## Useful Links

- [Education Board Results](https://eboardresults.com)
- [National University Results](https://www.nu.ac.bd/results)
- [Bangladesh Public Service Commission](https://www.bpsc.gov.bd)

## Developer Integration / API Access

The official Bangladesh Education Board web portal does not provide a public, free-to-use developer API due to security, CAPTCHA restrictions, and heavy server loads during result publications. However, developers looking to integrate SSC, HSC, or JSC result functionalities into their applications or websites can utilize the following alternative methods:

### 1. Third-Party Integration Platforms

Third-party platforms like Education Board Result API & Widget allow you to embed real-time results directly onto external websites.

- **Widget Integration**: Place a pre-built search widget directly on your site via a simple Javascript script tag snippet.
- **API Access**: Fetch programmatic structured data for schools, colleges, educational blogs, or portals.

### 2. Custom Web Scrapers (Self-Hosted API)

Many developers build custom REST APIs by scraping the official Web Based Result Publication System. This project utilizes this method via the `server.js` proxy.

- **The Process**: Use languages like Python (with BeautifulSoup/Selenium) or Node.js (with Puppeteer/node-fetch) to send POST requests containing the student's exam type, board, year, roll, and registration number.
- **The Challenge**: The official portal uses a graphical CAPTCHA to block automated bots. To bypass this programmatically, your custom API must integrate an automated OCR solver or a manual captcha-solving service.

### 3. Open Data Datasets

If you require historical analytic data rather than real-time individual student marks, you can check public resources like the Public Exam Result Data on the Bangladesh Open Data portal.

## Technology

This project is built with plain HTML, CSS, and JavaScript. It is optimized for Google Search Engine and is hosted on GitHub Pages.

## License

Open source project for educational purposes.