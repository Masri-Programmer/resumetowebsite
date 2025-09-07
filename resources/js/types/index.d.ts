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

export interface Rules {
    required?: boolean;
    min?: number;
    max?: number;
    email?: boolean;
    url?: boolean;
    numeric?: boolean;
    date?: boolean;
}

export type FieldType = 'text' | 'email' | 'number' | 'url' | 'date' | 'textarea';

export interface Field {
    placeholder: string;
    label: string;
    type: FieldType;
    rules: Rules;
    component?: 'textarea';
}

export type FieldGroup = Record<string, Field>;

export interface Actions {
    add: boolean;
    remove: boolean;
}

export interface Section {
    title: string;
    description: string;
    actions: Actions;
    fields: FieldGroup[];
}

export type Schema = Record<string, Section>;

interface Skill {
    skill: string;
}

interface Hobby {
    hobby: string;
}

interface Location {
    city: string;
    state: string | null;
    address: string | null;
    country: string;
    zipCode: string | null;
}

interface Project {
    project: string;
}

interface Education {
    degree: string;
    details: string;
    institution: string | null;
    graduationDate: string | null;
}

interface SocialLinks {
    other: string | null;
    github: string | null;
    twitter: string | null;
    linkedin: string | null;
    instagram: string | null;
}

interface Achievement {
    achievement: string;
}

interface PersonalInfo {
    email: string;
    mobile: string | null;
    website: string;
    lastName: string;
    firstName: string;
}

interface WorkExperience {
    role: string;
    company: string | null;
    endDate: string;
    startDate: string;
    description: string;
}

interface ResumeData {
    skills: Skill[];
    hobbies: Hobby[];
    location: Location[];
    projects: Project[];
    education: Education[];
    socialLinks: SocialLinks[];
    achievements: Achievement[];
    personalInfo: PersonalInfo[];
    workExperience: WorkExperience[];
}
export interface PageProps extends AppPageProps {
    [key: string]: unknown;
    portfolio?: ResumeData;
    flash?: {
        success?: string;
        parsed_data?: Partial<ResumeData>;
    };
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Resume {
    id: number;
    user_id: number;
    data: ResumeData;
    created_at: string;
    updated_at: string;
}


