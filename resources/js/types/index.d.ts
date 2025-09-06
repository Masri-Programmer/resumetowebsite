import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

// --- RESUME FORM TYPES ---
export interface FieldDefinition {
    placeholder: string;
    type: string;
    value: string;
    rules: FieldRules;
    class?: string;
    component?: 'textarea';
}
export interface FieldRules {
    required?: boolean;
    min?: number;
    max?: number;
    email?: boolean;
    url?: boolean;
    numeric?: boolean;
    date?: boolean;
    [key: string]: any;
}
export interface FormField {
    name: string;
    label: string;
    placeholder: string;
    type?: string;
    class?: string;
    component?: 'textarea';
    value: string | number | string[] | null;
    rules: FieldRules;
}
export type FieldGroup = Record<string, FieldDefinition>;
export interface ResumeSection {
    title: string;
    description: string;
    type: 'fields' | 'group'; // 'group' is for repeatable sections.
    actions: {
        add: boolean;
        remove: boolean;
    };
    /**
     * An array of field groups. For sections like "Work Experience",
     * this array will grow as the user adds more entries. For sections like
     * "Personal Info", it will contain just one FieldGroup.
     */
    fields: FieldGroup[];
}

export interface BaseSection {
    title: string;
    description: string;
    actions: {
        add: boolean;
        remove: boolean;
    };
}

export interface FieldsSection extends BaseSection {
    type: 'fields';
    fields: FormField[];
}

export interface ArraySection extends BaseSection {
    type: 'array';
    fields: FormField[];
}

type Section = FieldsSection | ArraySection;

export interface ParsedData {
    personalInfo: ResumeSection;
    location: ResumeSection;
    socialLinks: ResumeSection;
    workExperience: ResumeSection;
    education: ResumeSection;
    skills: ResumeSection;
    achievements: ResumeSection;
    projects: ResumeSection;
    hobbies: ResumeSection;
    [key: string]: ResumeSection;
}

// --- MISC PAGE PROPS ---

export interface PageProps {
    [key: string]: unknown;
    flash?: {
        success?: string;
        parsed_data?: ParsedData;
    };
}

export type BreadcrumbItemType = BreadcrumbItem;
