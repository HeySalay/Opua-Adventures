# Opua Adventures: CSS Style Guide (V2)

The rulebook for writing CSS in V2. Follow it so every file looks and reads the same.

---

## 1. File & layer structure

All CSS lives in `src/css/`. `styles.css` only sets the layer order and imports the other files.

| File | Layer | What goes in it |
|---|---|---|
| `reset.css` | `reset` | Clearing browser defaults (box-sizing, margins, images) |
| `tokens.css` | `tokens` | `:root` variables only: colors, type, spacing, radius, shadows |
| `base.css` | `base` | Plain HTML elements: `body`, `h1`–`h3`, `p`, `a`, `button` |
| `layout.css` | `layout` | Page structure: `.container`, `.section`, `.card-grid`, header/footer layout |
| `components.css` | `components` | `.btn`, `.card`, `.banner`, `.faq-item`, `.icon-list` … |
| `utilities.css` | `utilities` | One-job helpers: `.text-center`, `.visually-hidden`, `.title-xl` |
| `themes.css` | `themes` | `[data-theme="…"]` overrides of tokens only |

**Rules**
- Later layers win: `reset → tokens → base → layout → components → utilities → themes`.
- Never wrap a file's contents in `@layer { }`. The `@import … layer()` line already does that.
- Never write CSS outside a layer, since unlayered CSS beats everything.
- No `!important`. If you need it, the rule is in the wrong layer.
- `@import` paths are relative to `styles.css`: `url("base.css")`, not `url("css/base.css")`.

---

## 2. Tokens

- No raw values outside `tokens.css`: no hex colors, pixel font sizes, or one-off shadows. Always `var(--…)`.
- Naming: `--{category}-{name}` with `--` before a variant.
  - `--color-primary`, `--color-accent--alt`, `--color-text--dark`
  - `--space-md`, `--text-lg`, `--radius`, `--shadow`
- Themes override **purpose** tokens only (`--color-primary`), never component CSS.

---

## 3. Color pairings

Text must hit **4.5:1** contrast (normal text) or **3:1** (large bold text 24px+, icons, borders).

| Background | ✅ Use these for text & icons | ❌ Never |
|---|---|---|
| White / `--color-light` | `text--dark` (14.7), `text--mid` (7.0), `primary` (6.9), `accent-ui` (9.3) | `secondary`, `accent`, white |
| `--color-primary` | `text--light` / white (6.6–6.9) | dark text |
| `--color-secondary` (sky) | **`text--dark` only** (6.4) | white (2.3), `text--mid` (3.0), orange (1.3) |
| `--color-tertiary` (teal) | `text--light` / white (5.0–5.2) | dark text (2.8) |
| `--color-accent` (orange) | **`text--dark`** (8.0) or `accent-ui` (5.1) | white (1.8), `primary` for small text (3.7) |
| `--color-accent--alt` (coral) | white / `text--light` (4.8–5.0) | dark text, orange (2.7) |
| `--color-accent-ui` (navy) | `text--light` / white (8.9+), orange (5.1), sky for large text (4.0) | teal (1.8), dark text |

**Shortcuts**
- Sky blue and orange always get dark text.
- Never put sky blue and orange on top of each other. Separate them with white, `--color-light`, or a dark color.
- Orange buttons go on white, light, primary, navy, or teal backgrounds, never on sky blue.
- Icons use `currentColor` so they always match their text.

---

## 4. Naming classes (BEM)

Name classes for **what they are**, not where they appear.

| Part | Pattern | Example |
|---|---|---|
| Block | `.block` | `.card` |
| Element | `.block__element` | `.card__header`, `.card__footer` |
| Modifier | `.block--modifier` | `.card--featured`, `.btn--accent` |

- ✅ `.card-grid` · ❌ `.ready-to-book-grid`
- ✅ `.section-header` · ❌ `.how-adventures-work-header`
- Use IDs only for JavaScript hooks and anchor links, never for styling.

---

## 5. Comment template

```css
/* ==========================================================================
   FILE NAME
   What this file is for, in one or two lines.
   ========================================================================== */


/* --------------------------------------------------------------------------
   Section Name
   Optional: a note on how or when to use this section.
   -------------------------------------------------------------------------- */


/* Subsection Name
   -------------------- */


.example {
  margin-top: auto;   /* inline note: explain WHY, not what */
}

/* TODO: something to come back to */
```

- One style per level: `====` file, `----` section, short underline subsection.
- Comment the **why**, never the obvious **what**.
- Search for `TODO:` before each release.

---

## 6. Property order

Order every rule from "where is it?" to "what does it look like?" Leave a blank line between groups if it helps readability.

1. **Positioning:** `position`, `inset` / `top` / `right` / `bottom` / `left`, `z-index`
2. **Display & layout:** `display`, `grid-*`, `flex-*`, `place-*` / `align-*` / `justify-*`, `gap`, `order`
3. **Box model:** `box-sizing`, `width`, `min-/max-width`, `height`, `min-/max-height`, `aspect-ratio`, `margin`, `padding`, `overflow`
4. **Typography:** `font-family`, `font-size`, `font-weight`, `line-height`, `letter-spacing`, `text-align`, `text-transform`, `text-wrap`, `white-space`, `color`
5. **Visual:** `background`, `border`, `border-radius`, `outline`, `box-shadow`, `opacity`, `object-fit`
6. **Motion & interaction:** `transition`, `animation`, `transform`, `cursor`, `pointer-events`

```css
.card {
  position: relative;

  display: grid;
  grid-row: span 3;
  grid-template-rows: subgrid;
  gap: 0;

  overflow: hidden;

  color: var(--color-text);

  background: var(--color-bg);
  border-radius: var(--radius);
  box-shadow: var(--shadow);

  transition: transform var(--duration) var(--ease);
}
```

---

## 7. Sizing

Body text is 16px on phones and grows to 18px on desktop. Every other size steps up from there. Full tables (with sizes at phone, tablet and laptop widths) are in the Sizing Guide.

**Type scale** (grows smoothly between a 360px and a 1280px screen)

| Token | Phone → 1280px+ | Use |
|---|---|---|
| `--text-sm` | 14px | Captions, dates, footer legal |
| `--text-base` | 16 → 18px | Body text, buttons, inputs |
| `--text-lg` | 20 → 24px | `h3`, card titles, banner subtitle |
| `--text-xl` | 24 → 32px | `h2`, section titles |
| `--text-2xl` | 30 → 44px | `h1` on inner pages |
| `--text-3xl` | 36 → 56px | Homepage hero `h1` only |

**Spacing scale** (4px grid)

| Token | Size | Use |
|---|---|---|
| `--space-2xs` | 4px | Icon ↔ its text |
| `--space-xs` | 8px | Tight gaps: list items, pills |
| `--space-sm` | 12px | Button padding (top/bottom), label ↔ input |
| `--space-md` | 16px | Paragraph spacing, page side gutters |
| `--space-lg` | 24px | Card padding, card grid gap |
| `--space-xl` | 32px | Section header ↔ its content |
| `--space-2xl` | 48px | Between big blocks inside one section |
| `--space-section` | 48 → 96px | Top and bottom padding of every `.section` |

- **Small inside, big between:** `2xs`–`lg` inside a component, `xl`–`2xl` between components, `--space-section` between sections.
- If a gap looks wrong, move one step up or down the scale. Never invent a value like `1.75rem`.

**Which unit for which job**

| Job | Unit |
|---|---|
| Font sizes | Type tokens (`rem` + `clamp()`) |
| Margins, padding, gaps | Spacing tokens (`rem`) |
| Padding inside buttons, icon sizes | `em` |
| Text width | `ch` (`max-width: 65ch`) |
| Banner and hero heights | `svh` (`60svh` banner, `85svh` homepage hero) |
| Borders, shadows | `px` |
| Never on screen | `pt` |

**Sizing rules**
- Line height: `--leading-normal` (1.6) for body, `--leading-tight` (1.2) for headings.
- Form inputs are at least `1rem` (16px), or iPhones zoom the page when they're tapped.
- Tap targets are at least 44 × 44px.
- Use `svh`, not `vh` or `dvh`, for banner heights: `vh` can be taller than a phone screen, and `dvh` jumps as the toolbar slides away.

---

## 8. Layout rules

- Prefer **grid** for 2D layouts (cards, sections, footers) and **flexbox** for 1D rows (nav, button groups, icon + text).
- Card grids: `repeat(auto-fit, minmax(min(100%, 280px), 1fr))` instead of breakpoints.
- Matching card headers/footers: `grid-template-rows: subgrid` + `grid-row: span 3`.
- Put `min-width: 0` on grid and flex children that hold images or long text.
- Spacing comes from `gap` and margins, never `<br>` or `&nbsp;`.
- Content is capped with `.container` at `--width-content` (72rem / 1152px).
- Breakpoints: use only `48em` (768px, tablet) and `64em` (1024px, desktop). CSS variables can't be used inside `@media ( )`, so these stay as numbers.

---

## 9. Accessibility checklist

- Every interactive element has a visible `:focus-visible` style.
- Smooth scrolling only inside `@media (prefers-reduced-motion: no-preference)`.
- Icon-only buttons have an `aria-label`.
- One `<h1>` per page; headings go in order (`h1 → h2 → h3`). Size them with `.title-*` classes, not by picking a different tag.
- Check new color combinations against Section 3 before using them.
