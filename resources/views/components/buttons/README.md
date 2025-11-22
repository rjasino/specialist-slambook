# Button Components Documentation

This directory contains reusable button components for the Slambook application.

## Available Components

### 1. Primary Button Component

**Location:** `resources/views/components/buttons/primary-button.blade.php`

A reusable primary button component with customizable properties. Use for main actions.

#### Usage:

```blade
<x-buttons.primary-button
    text="Save Changes"
    size="medium"
    submit
/>
```

#### Props:

-   `type` (optional, default: "button"): Button type (button, submit, reset)
-   `href` (optional): If provided, renders as anchor tag instead of button
-   `text` (optional, default: "Submit"): Button text
-   `icon` (optional): HTML/SVG icon to display
-   `size` (optional, default: "medium"): Button size (small, medium, large)
-   `submit` (optional, default: false): Shortcut to set type="submit"

#### Examples:

```blade
<!-- Basic submit button -->
<x-buttons.primary-button text="Save" submit />

<!-- Link button -->
<x-buttons.primary-button href="{{ route('home') }}" text="Go Home" />

<!-- Button with icon -->
<x-buttons.primary-button submit>
    <x-slot:icon>
        <svg>...</svg>
    </x-slot>
    Submit Form
</x-buttons.primary-button>

<!-- Large size -->
<x-buttons.primary-button text="Continue" size="large" />

<!-- Disabled button -->
<x-buttons.primary-button text="Submit" submit disabled />
```

---

### 2. Secondary Button Component

**Location:** `resources/views/components/buttons/secondary-button.blade.php`

A reusable secondary button component. Use for less prominent actions like cancel or back.

#### Usage:

```blade
<x-buttons.secondary-button
    text="Cancel"
    href="{{ url('/') }}"
/>
```

#### Props:

-   `type` (optional, default: "button"): Button type (button, submit, reset)
-   `href` (optional): If provided, renders as anchor tag instead of button
-   `text` (optional, default: "Cancel"): Button text
-   `icon` (optional): HTML/SVG icon to display
-   `size` (optional, default: "medium"): Button size (small, medium, large)
-   `submit` (optional, default: false): Shortcut to set type="submit"

#### Examples:

```blade
<!-- Basic cancel button -->
<x-buttons.secondary-button text="Cancel" />

<!-- Back link -->
<x-buttons.secondary-button href="{{ url()->previous() }}" text="Go Back" />

<!-- With onclick event -->
<x-buttons.secondary-button
    text="Close"
    onclick="closeModal()"
/>

<!-- Small size -->
<x-buttons.secondary-button text="Skip" size="small" />
```

---

### 3. Edit Button Component

**Location:** `resources/views/components/buttons/edit-button.blade.php`

A reusable edit button component with customizable properties.

#### Usage:

```blade
<x-buttons.edit-button
    :route="route('slambook.edit', $slambook->id)"
    text="Edit Slambook"
    size="medium"
/>
```

#### Props:

-   `route` (required): The URL/route for the edit action
-   `text` (optional, default: "Edit"): Button text
-   `icon` (optional, default: true): Show/hide icon
-   `size` (optional, default: "medium"): Button size (small, medium, large)

#### Examples:

```blade
<!-- Basic usage -->
<x-buttons.edit-button :route="route('item.edit', $id)" />

<!-- Custom text -->
<x-buttons.edit-button :route="route('item.edit', $id)" text="Modify" />

<!-- Small size without icon -->
<x-buttons.edit-button :route="route('item.edit', $id)" size="small" :icon="false" />

<!-- Large size -->
<x-buttons.edit-button :route="route('item.edit', $id)" size="large" />
```

---

### 4. Delete Button Component

**Location:** `resources/views/components/buttons/delete-button.blade.php`

A reusable delete button component with confirmation dialog and form submission.

#### Usage:

```blade
<x-buttons.delete-button
    :route="route('slambook.destroy', $slambook->id)"
    text="Delete Slambook"
    confirmMessage="Are you sure you want to delete this?"
    formId="delete-form-unique-id"
/>
```

#### Props:

-   `route` (required): The URL/route for the delete action
-   `method` (optional, default: "DELETE"): HTTP method
-   `text` (optional, default: "Delete"): Button text
-   `confirmMessage` (optional): Custom confirmation message
-   `icon` (optional, default: true): Show/hide icon
-   `size` (optional, default: "medium"): Button size (small, medium, large)
-   `formId` (optional, auto-generated): Custom form ID for multiple delete buttons

#### Examples:

```blade
<!-- Basic usage -->
<x-buttons.delete-button :route="route('item.destroy', $id)" />

<!-- Custom confirmation message -->
<x-buttons.delete-button
    :route="route('item.destroy', $id)"
    confirmMessage="This will permanently delete this item. Continue?"
/>

<!-- Custom text and size -->
<x-buttons.delete-button
    :route="route('item.destroy', $id)"
    text="Remove Item"
    size="small"
/>

<!-- Multiple delete buttons on same page -->
<x-buttons.delete-button
    :route="route('item.destroy', $item1->id)"
    formId="delete-item-1"
/>
<x-buttons.delete-button
    :route="route('item.destroy', $item2->id)"
    formId="delete-item-2"
/>
```

---

## Styling

Button styles are defined in `resources/css/buttons.css`.

### Available CSS Classes:

-   `.btn-edit`, `.btn-edit-sm`, `.btn-edit-lg` - Edit button styles
-   `.btn-delete`, `.btn-delete-sm`, `.btn-delete-lg` - Delete button styles

### Color Scheme:

-   **Edit Button**: Pink/Purple gradient (#f093fb → #f5576c)
-   **Delete Button**: Red gradient (#ff0844 → #ff6b6b)

---

## Notes

1. **Flexible Rendering**: Buttons can render as `<button>` or `<a>` tags based on `href` prop
2. **Slot Support**: Can use slot for custom content including icons
3. **Auto-generated Form IDs**: Delete buttons automatically generate unique form IDs if not provided
4. **Confirmation Dialog**: Delete buttons include a JavaScript confirmation prompt
5. **CSRF Protection**: Forms automatically include CSRF tokens
6. **Method Spoofing**: DELETE method is automatically handled via @method directive
7. **Responsive**: Buttons are mobile-responsive (full width on small screens)
8. **Accessibility**: Icons are inline SVGs for better control and performance
9. **Disabled State**: All buttons support disabled attribute with proper styling

---

## Integration

These components are included in the project via:

-   **Vite Config**: `resources/css/buttons.css` is compiled
-   **Layout**: Included in `app.blade.php` layout

---

## Future Components

Consider creating additional button components:

-   Submit Button Component
-   Cancel Button Component
-   Save Button Component
-   Back Button Component
