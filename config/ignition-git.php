<?php

/*
|--------------------------------------------------------------------------
| Ignition Git Configuration
|--------------------------------------------------------------------------
|
| da da da
|
*/
return [
    'token' => env('IGNITION_GIT_TOKEN'),
    'issue' => [
        'template' => "
**:title:**

The following exception occurred:

```
:exception_message:
```

This issue was introduced after the following commit: [:commit_sha:](:hash_url:)

> This is an automated issue via reaecem/ignition-git

",
        'bug_report' => "
---
name: Bug report
about: Create a report to help us improve
title: :title:
labels: :labels:
assignees: :assignees:

---

**Describe the bug**
:title:

**To Reproduce**
Steps to reproduce the behavior:
1. Go to '...'
2. Click on '....'
3. Scroll down to '....'
4. See error

**Expected behavior**
A clear and concise description of what you expected to happen.

**Screenshots**
If applicable, add screenshots to help explain your problem.

**Desktop:**
 - OS: [e.g. iOS]
 - Browser [e.g. chrome, safari]
 - Version [e.g. 22]

**Smartphone:**
 - Device: [e.g. iPhone6]
 - OS: [e.g. iOS8.1]
 - Browser [e.g. stock browser, safari]
 - Version [e.g. 22]

**Additional context**
Add any other context about the problem here.
"
    ]
];