# Team Showcase Plugin

## Overview

The Team Showcase Plugin is a custom WordPress implementation that provides:

- A Custom Post Type (`team_member`)
- Custom Meta Fields (Role, Short Bio)
- A responsive shortcode-based team grid
- A theme template override for single team members
- A custom REST API namespace (`2creative/v1`)
- SEO enhancements (Structured Data + Index control)
- Security, scalability, and production-readiness considerations

This solution focuses on clean architecture, WordPress best practices, SEO awareness, and scalability planning.

---

## Requirements

- WordPress (latest stable version)
- PHP 7.4+
- A theme that supports template overrides (e.g., Twenty Twenty-Four)

---

## Installation

1. Upload the `team-showcase` folder to:
   `/wp-content/plugins/`
2. Activate the plugin via WordPress Admin.
3. Go to Settings → Permalinks → Click “Save” to flush rewrite rules.
4. Create a page and add the shortcode:

   [team_showcase]

---

## Custom Post Type

Post Type: `team_member`

Supports:
- Title
- Editor (Full Bio)
- Featured Image (Photo)
- Custom Meta Fields

Admin Visibility:
- Appears as “Team Members” in WordPress Admin Menu.

Rewrite:
- Slug: `/team/`

---

## Custom Fields (Stored in Post Meta)

The following meta fields are stored using WordPress post meta:

- `_ts_role`
- `_ts_short_bio`

Security Measures:
- Nonce verification
- Sanitization on save
- Escaping on output
- Autosave protection

---

## Shortcode

Shortcode:

    [team_showcase]

Functionality:
- Displays all published team members
- Responsive grid layout
- Shows name, role, photo, and short bio

### Filtering by Role

Supports URL-based filtering:

    https://example.com/team-page/?role=designer

Only team members with role “designer” will be shown.

---

## Theme Template Override

File:

    single-team_member.php

Displays:
- Team member name
- Role
- Featured image
- Full bio content

Includes:
- Semantic HTML5 markup
- Responsive layout
- JavaScript-powered interaction (expand/collapse)

No heavy frameworks used.

---

## Custom REST API

Namespace:

    2creative/v1

### Get All Team Members

Endpoint:

    GET /wp-json/2creative/v1/team-members

Example:

    https://example.com/wp-json/2creative/v1/team-members

Response Format:

[
  {
    "id": 12,
    "name": "John Doe",
    "role": "Designer",
    "short_bio": "Creative UI/UX Designer",
    "photo_url": "https://example.com/uploads/john.jpg",
    "permalink": "https://example.com/team/john-doe"
  }
]

---

### Get Single Team Member

Endpoint:

    GET /wp-json/2creative/v1/team-members/{id}

Example:

    https://example.com/wp-json/2creative/v1/team-members/12

Behavior:
- Validates ID parameter as integer
- Returns 404 if team member does not exist
- Returns structured JSON response

---

## SEO Implementation (Mandatory)

### Structured Data (JSON-LD)

Single team member pages output JSON-LD structured data using Schema.org:

Type: Person

Includes:
- name
- jobTitle
- description
- image
- url

Injected using wp_head.

---

### Duplicate Content Prevention

Issue Identified:
URL parameters such as `?role=` can create duplicate content variations.

Mitigation:
- Pages with `?role=` are set to:

    <meta name="robots" content="noindex, follow">

This prevents unnecessary indexation while preserving link equity.

---

### Canonical Handling

Default WordPress canonical behavior is preserved for:

- Single team member pages
- Archive pages

Filtered parameter-based URLs are prevented from indexation.

---

## SEO Risks Identified

1. Duplicate content via query parameters
2. Meta-query performance impact
3. Large REST payload responses
4. Thin content risk if short bio missing

---

## SEO Mitigation Strategy

- Structured data added for enhanced SERP visibility
- Noindex for filter-based URLs
- Clean permalink structure
- Proper semantic HTML markup
- Internal linking via individual member pages

---

## Performance Considerations

Potential Bottlenecks:

- Meta query filtering for large datasets
- REST endpoint returning all members without pagination
- No caching layer implemented by default

---

## Scaling Strategy for 5,000+ Team Members

If the dataset grows significantly:

1. Convert `role` from post meta to taxonomy (indexed queries)
2. Implement pagination in REST endpoints
3. Implement transient caching for shortcode queries
4. Add object caching (Redis/Memcached)
5. Consider custom database table for advanced filtering
6. Add REST response caching layer

---

## Security Best Practices Implemented

- Nonce verification for meta saving
- Sanitization (`sanitize_text_field`, `sanitize_textarea_field`)
- Escaping (`esc_html`, `esc_attr`)
- REST ID validation
- Proper HTTP status codes
- Direct access prevention (`ABSPATH` check)

---

## Production Caching Strategy

Recommended for live environment:

- Page caching (server-level or plugin)
- Object caching (Redis)
- CDN for images
- Transient caching for heavy queries
- REST pagination to reduce payload size

---

## Deployment Strategy

1. Version control (Git)
2. Deploy via CI/CD pipeline
3. Test on staging environment
4. Backup database before deployment
5. Monitor REST performance and logs post-launch

---

## Leadership & Collaboration Scenarios

### If SEO Requests URL Structure Change

- Update rewrite rules
- Implement 301 redirects
- Preserve backward compatibility
- Update sitemap
- Monitor crawl errors

---

### If Marketing Demands Heavy Design That Impacts Performance

- Present performance impact metrics
- Propose optimized alternatives
- Balance design with Core Web Vitals
- Align with business objectives

---

### Developer & SEO Collaboration Structure

- Define URL structure before launch
- Review structured data together
- Validate indexing strategy
- Post-launch performance and crawl monitoring

---

## Assumptions

- Role stored as post meta as per assignment requirement
- No authentication required for GET endpoints
- Filtering handled via URL parameter

---

## Future Improvements

- REST pagination
- AJAX filtering via REST
- Gutenberg block for insertion
- Custom admin columns (Role, Photo)
- Transient caching layer
- Taxonomy-based role filtering

---

## Folder Structure

team-showcase/
- team-showcase.php
- uninstall.php
- assets/
- includes/
- templates/

Code is separated by responsibility:
- Post type registration
- Meta handling
- Query logic
- Shortcode rendering
- REST controller

---

## Conclusion

This implementation demonstrates:

- Clean WordPress architecture
- REST API best practices
- SEO awareness and duplicate prevention
- Security-focused data handling
- Scalability planning
- Production-readiness thinking

The plugin is structured for maintainability and future extensibility while keeping dependencies minimal and aligned with core WordPress standards.