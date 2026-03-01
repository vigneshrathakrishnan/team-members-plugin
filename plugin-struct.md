team-showcase/
│
├── team-showcase.php
├── uninstall.php
├── README.md
│
├── assets/
│   ├── css/
│   │   └── team-showcase.css
│   └── js/
│       └── team-showcase.js
│
├── includes/
│   ├── class-team-member-post-type.php
│   ├── class-team-member-meta.php
│   ├── class-team-query.php
│   ├── class-team-showcase-shortcode.php
│   └── class-team-rest-controller.php
│
└── templates/
    └── team-showcase-grid.php



# Create directories
mkdir -p team-showcase/assets/css
mkdir -p team-showcase/assets/js
mkdir -p team-showcase/includes
mkdir -p team-showcase/templates

# Create root files
touch team-showcase/team-showcase.php
touch team-showcase/uninstall.php
touch team-showcase/README.md

# Create asset files
touch team-showcase/assets/css/team-showcase.css
touch team-showcase/assets/js/team-showcase.js

# Create include files
touch team-showcase/includes/class-team-member-post-type.php
touch team-showcase/includes/class-team-member-meta.php
touch team-showcase/includes/class-team-query.php
touch team-showcase/includes/class-team-showcase-shortcode.php
touch team-showcase/includes/class-team-rest-controller.php

# Create template file
touch team-showcase/templates/team-showcase-grid.php