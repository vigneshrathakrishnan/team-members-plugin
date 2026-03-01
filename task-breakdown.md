# 🔎 Senior WordPress Technical Review

## Structured Task Breakdown – Team Showcase Assignment

---

# CORE FUNCTIONAL TASKS

---

### **T1**

* **Title:** Create Plugin Skeleton
* **Description:** Create plugin directory, main plugin file with headers, activation hooks (if any), and proper structure.
* **Type:** Architecture
* **Priority:** High
* **Dependency:** None
* **Risk:** Low

---

### **T2**

* **Title:** Register Custom Post Type `team_member`
* **Description:** Register CPT with admin visibility and support for title, editor, featured image.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T1
* **Risk:** Low
* **DB Impact:** Uses `wp_posts`

---

### **T3**

* **Title:** Configure CPT Labels & Rewrite Rules
* **Description:** Define proper labels, rewrite slug, public visibility settings.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T2
* **Risk:** Medium
* **SEO Impact:** Yes (URL structure & indexing)

---

### **T4**

* **Title:** Add Custom Meta Fields (Name, Role, Short Bio)
* **Description:** Create meta box UI and save fields via `post_meta`.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T2
* **Risk:** Medium
* **DB Impact:** Uses `wp_postmeta`
* **Scalability Concern:** Postmeta query inefficiency at 5,000+ records

---

### **T5**

* **Title:** Implement Meta Sanitization & Escaping
* **Description:** Sanitize on save, escape on output.
* **Type:** Security
* **Priority:** High
* **Dependency:** T4
* **Risk:** High (Security)

---

### **T6**

* **Title:** Create Shortcode `[team_showcase]`
* **Description:** Register shortcode handler.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T2
* **Risk:** Low

---

### **T7**

* **Title:** Query Published Team Members
* **Description:** WP_Query to fetch published posts.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T6
* **Risk:** Medium
* **DB Impact:** Yes
* **Scalability Risk:** Query cost at 5,000+ entries

---

### **T8**

* **Title:** Implement Role Filtering via `?role=`
* **Description:** Read URL param and filter team members.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T7
* **Risk:** High
* **SEO Impact:** Duplicate content risk
* **DB Impact:** Meta query

---

### **T9**

* **Title:** Build Responsive Grid Layout
* **Description:** Output HTML/CSS grid for members.
* **Type:** Frontend
* **Priority:** High
* **Dependency:** T6
* **Risk:** Low

---

# THEME TEMPLATE TASKS

---

### **T10**

* **Title:** Create `single-team_member.php`
* **Description:** Override single template in theme/child theme.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T2
* **Risk:** Low

---

### **T11**

* **Title:** Display Structured Member Layout
* **Description:** Render name, role, photo, full bio using semantic HTML5.
* **Type:** Frontend
* **Priority:** High
* **Dependency:** T10
* **Risk:** Low
* **SEO Impact:** Yes

---

### **T12**

* **Title:** Add JavaScript Interaction
* **Description:** Implement toggle/modal/tabs.
* **Type:** Frontend
* **Priority:** Medium
* **Dependency:** T11
* **Risk:** Low
* **Performance Impact:** JS weight must be minimal

---

# REST API TASKS

---

### **T13**

* **Title:** Register REST Namespace `2creative/v1`
* **Description:** Use `register_rest_route`.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T1
* **Risk:** Low

---

### **T14**

* **Title:** Create Route `/team-members`
* **Description:** Return published members.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T13
* **Risk:** Medium
* **DB Impact:** Yes
* **Scalability Risk:** Large dataset response

---

### **T15**

* **Title:** Create Route `/team-members/{id}`
* **Description:** Return single member.
* **Type:** Functional
* **Priority:** High
* **Dependency:** T13
* **Risk:** Medium

---

### **T16**

* **Title:** Format API Response Schema
* **Description:** Include id, name, role, short_bio, photo_url, permalink.
* **Type:** Architecture
* **Priority:** High
* **Dependency:** T14, T15
* **Risk:** Low

---

### **T17**

* **Title:** Validate Route Parameters
* **Description:** Validate ID as integer.
* **Type:** Security
* **Priority:** High
* **Dependency:** T15
* **Risk:** Medium

---

### **T18**

* **Title:** Handle REST Error Cases
* **Description:** Return proper HTTP codes.
* **Type:** Security
* **Priority:** High
* **Dependency:** T14, T15
* **Risk:** Medium

---

# SEO TASKS (MANDATORY)

---

### **T19**

* **Title:** Add JSON-LD Structured Data
* **Description:** Add structured data to single team_member.
* **Type:** SEO
* **Priority:** High
* **Dependency:** T10
* **Risk:** Medium
* **SEO Impact:** High

---

### **T20**

* **Title:** Implement Canonical Tag Handling
* **Description:** Ensure correct canonical for filtered URLs.
* **Type:** SEO
* **Priority:** High
* **Dependency:** T8
* **Risk:** High
* **SEO Risk:** Duplicate indexation

---

### **T21**

* **Title:** Prevent Indexation of Filter Parameters
* **Description:** Add noindex or canonical for `?role=`.
* **Type:** SEO
* **Priority:** High
* **Dependency:** T8
* **Risk:** High

---

### **T22**

* **Title:** Document SEO Risk Mitigation
* **Description:** Explain duplicate avoidance, speed optimization, linking.
* **Type:** Documentation
* **Priority:** High
* **Dependency:** All SEO tasks
* **Risk:** Low

---

# PERFORMANCE TASKS

---

### **T23**

* **Title:** Optimize WP_Query for Large Dataset
* **Description:** Avoid unnecessary meta queries, use caching strategy.
* **Type:** Performance
* **Priority:** High
* **Dependency:** T7
* **Risk:** High

---

### **T24**

* **Title:** Optimize REST Response Size
* **Description:** Limit fields and avoid heavy payload.
* **Type:** Performance
* **Priority:** High
* **Dependency:** T14
* **Risk:** Medium

---

### **T25**

* **Title:** Implement Caching Strategy Plan
* **Description:** Define object/page caching approach.
* **Type:** Scalability
* **Priority:** Medium
* **Dependency:** T7, T14
* **Risk:** High

---

# SCALABILITY TASKS

---

### **T26**

* **Title:** Analyze 5,000+ Records Scenario
* **Description:** Evaluate postmeta performance limitations.
* **Type:** Scalability
* **Priority:** High
* **Dependency:** T4
* **Risk:** High
* **Hidden Expectation:** DB architecture awareness

---

### **T27**

* **Title:** Evaluate Need for Custom DB Table
* **Description:** Consider normalization vs postmeta.
* **Type:** Architecture
* **Priority:** Medium
* **Dependency:** T26
* **Risk:** High

---

# SECURITY TASKS

---

### **T28**

* **Title:** Implement Nonce Verification for Meta Saving
* **Description:** Prevent CSRF.
* **Type:** Security
* **Priority:** High
* **Dependency:** T4
* **Risk:** High

---

### **T29**

* **Title:** Restrict Admin Capabilities Properly
* **Description:** Ensure correct capability mapping.
* **Type:** Security
* **Priority:** Medium
* **Dependency:** T2
* **Risk:** Medium

---

# DOCUMENTATION TASKS

---

### **T30**

* **Title:** Create README with Setup Instructions
* **Type:** Documentation
* **Priority:** High
* **Dependency:** All
* **Risk:** Low

---

### **T31**

* **Title:** Document REST Endpoints with Examples
* **Type:** Documentation
* **Priority:** High
* **Dependency:** T14, T15
* **Risk:** Low

---

### **T32**

* **Title:** Provide Architecture Explanation (Video)
* **Type:** Documentation
* **Priority:** High
* **Dependency:** All
* **Risk:** Medium
* **Hidden Expectation:** Senior-level thinking

---

### **T33**

* **Title:** Answer Leadership & Collaboration Questions
* **Type:** Documentation
* **Priority:** High
* **Dependency:** All
* **Risk:** Medium
* **Hidden Expectation:** Soft skills & senior maturity

---

### **T34**

* **Title:** Production Readiness Explanation
* **Description:** Security, bottlenecks, caching, deployment.
* **Type:** Architecture
* **Priority:** High
* **Dependency:** All
* **Risk:** Medium

---

# BONUS TASKS

---

### **T35**

* **Title:** Implement AJAX Filtering via REST
* **Type:** Functional
* **Priority:** Low
* **Dependency:** T14
* **Risk:** Medium

---

### **T36**

* **Title:** Create Gutenberg Block
* **Type:** Architecture
* **Priority:** Low
* **Dependency:** T6
* **Risk:** Medium

---

### **T37**

* **Title:** Add Custom Admin Columns
* **Type:** Functional
* **Priority:** Low
* **Dependency:** T2
* **Risk:** Low

---

# ⚠️ UNCLEAR / AMBIGUOUS REQUIREMENTS

1. Should role be taxonomy instead of meta? (Scalability implication)
2. Should REST endpoint support pagination?
3. Should shortcode support pagination?
4. Expected structured data schema type? (Person? Organization member?)
5. Should filter URLs be crawlable landing pages?
6. Performance benchmark expectation?
7. Caching allowed via plugin or must be conceptual only?
8. Should REST endpoint include pagination for 5,000 records?

---

# 🎯 Hidden Expectations (What They’re Actually Testing)

* Whether you understand **postmeta scaling problems**
* Whether you understand **SEO duplicate content**
* Whether you understand **REST payload control**
* Whether you understand **template hierarchy**
* Whether you understand **caching layers**
* Whether you think like a production engineer
* Whether you can communicate like a tech lead

This is **not** a plugin test.
This is a **senior architecture evaluation disguised as a small assignment.**

---

# 📊 TOTAL TASKS IDENTIFIED

**37 Atomic Tasks**

---

# ❓ Areas Needing Clarification

1. Expected dataset size in real-world scenario?
2. Pagination requirements?
3. Taxonomy vs postmeta for role?
4. SEO indexing strategy expectation?
5. Expected performance target?
6. Deployment environment assumptions?

---

# 🏗 Estimated Complexity Level

**Senior-Level Assignment**

Reason:

* Requires architecture thinking
* SEO awareness
* Scalability planning
* REST API maturity
* Security practices
* Leadership communication

---

If you want, I can now:

* Convert this into a Notion-ready checklist
* Or turn this into a delivery strategy plan
* Or simulate how an interviewer would critique your approach
