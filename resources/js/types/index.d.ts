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

export interface ParsedData {
    personalInfo?: {
        firstName?: string;
        lastName?: string;
        email?: string;
        mobile?: string;
        website?: string;
        location?: {
            address?: string;
            city?: string;
            state?: string;
            country?: string;
            zipCode?: string;
        };
    };
    socialLinks?: {
        linkedin?: string;
        github?: string;
        [key: string]: any;
    };
    workExperience?: {
        role?: string;
        company?: string;
        startDate?: string;
        endDate?: string;
        description?: string[];
    }[];
    education?: {
        degree?: string;
        institution?: string;
        graduationDate?: string;
    }[];
    skills?: {
        technical?: string[];
        soft?: string[];
        languages?: string[];
    };
    projects?: {
        name?: string;
        description?: string;
        technologies?: string[];
    }[];
}

export interface PageProps {
    [key: string]: unknown;
    flash?: {
        success?: string;
        parsed_data?: ParsedData;
    };
}

export type BreadcrumbItemType = BreadcrumbItem;
