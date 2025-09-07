export const schema = {
    personalInfo: {
        title: 'Personal Information',
        description: 'Your personal contact details.',
        actions: { add: false, remove: false },
        fields: [
            {
                firstName: {
                    placeholder: 'e.g., John',
                    label: 'First Name',
                    type: 'text',
                    rules: { required: true, min: 2, max: 255 },
                },
                lastName: {
                    placeholder: 'e.g., Snow',
                    label: 'Last Name',
                    type: 'text',
                    rules: { required: true, min: 2, max: 255 },
                },
                email: {
                    placeholder: 'e.g., your@email.com',
                    label: 'Email Address',
                    type: 'email',
                    rules: { required: true, email: true },
                },
                mobile: {
                    placeholder: 'e.g., +49 123 456789',
                    label: 'Mobile Number',
                    type: 'number',
                    rules: { required: false, min: 10, max: 20 },
                },
                website: {
                    placeholder: 'e.g., https://www.your-portfolio.com',
                    label: 'Website',
                    type: 'url',
                    rules: { required: false, url: true },
                },
            },
        ],
    },
    location: {
        title: 'Location',
        description: 'Where you are currently based.',
        actions: { add: false, remove: false },
        fields: [
            {
                address: {
                    placeholder: 'e.g., Musterstraße 1',
                    label: 'Street Address',
                    type: 'text',
                    rules: { required: false, min: 5, max: 255 },
                },
                city: {
                    placeholder: 'e.g., Oldenburg',
                    label: 'City',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
                state: {
                    placeholder: 'e.g., Lower Saxony',
                    label: 'State/Province',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
                zipCode: {
                    placeholder: 'e.g., 26121',
                    label: 'Zip/Postal Code',
                    type: 'number',
                    rules: { required: false, numeric: true, min: 4, max: 10 },
                },
                country: {
                    placeholder: 'e.g., Germany',
                    label: 'Country',
                    type: 'text',
                    rules: { required: true, min: 2, max: 255 },
                },
            },
        ],
    },
    socialLinks: {
        title: 'Social & Professional Links',
        description: 'Links to your online profiles.',
        actions: { add: true, remove: false },
        fields: [
            {
                linkedin: {
                    placeholder: 'URL of your LinkedIn profile',
                    label: 'LinkedIn',
                    type: 'text',
                    rules: { required: false, url: true },
                },
                github: {
                    placeholder: 'URL of your GitHub profile',
                    label: 'GitHub',
                    type: 'text',
                    rules: { required: false, url: true },
                },
                twitter: {
                    placeholder: 'URL of your Twitter profile',
                    label: 'Twitter',
                    type: 'text',
                    rules: { required: false, url: true },
                },
                instagram: {
                    placeholder: 'URL of your Instagram profile',
                    label: 'Instagram',
                    type: 'text',
                    rules: { required: false, url: true },
                },
                other: {
                    placeholder: 'URL of a profile',
                    label: 'Other URL',
                    type: 'text',
                    rules: { required: false, url: true },
                },
            },
        ],
    },
    workExperience: {
        title: 'Work Experience',
        description: 'Your professional work history.',
        actions: { add: true, remove: true },
        fields: [
            {
                role: {
                    placeholder: 'e.g., Full Stack Developer',
                    label: 'Role',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
                company: {
                    placeholder: 'e.g., Tech Solutions Inc.',
                    label: 'Company',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
                startDate: {
                    placeholder: 'e.g., Oct 2022',
                    label: 'Start Date',
                    type: 'date',
                    rules: { required: false, date: true },
                },
                endDate: {
                    placeholder: 'e.g., Sep 2023 or Present',
                    label: 'End Date',
                    type: 'date',
                    rules: { required: false, date: true },
                },
                description: {
                    component: 'textarea',
                    placeholder: 'Enter each responsibility on a new line.',
                    label: 'Job Description',
                    type: 'text',
                    rules: { required: false, max: 2000 },
                },
            },
        ],
    },
    education: {
        title: 'Education',
        description: 'Your educational background.',
        actions: { add: true, remove: true },
        fields: [
            {
                degree: {
                    placeholder: 'e.g., B.Sc. in Computer Science',
                    label: 'Degree',
                    type: 'text',
                    rules: { required: true, min: 2, max: 255 },
                },
                institution: {
                    placeholder: 'e.g., University of Oldenburg',
                    label: 'Institution',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
                graduationDate: {
                    placeholder: 'e.g., Sep 2022',
                    label: 'Graduation Date',
                    type: 'date',
                    rules: { required: false, date: true },
                },
                details: {
                    component: 'textarea',
                    placeholder: 'e.g., Grade: 1.8\nFocus on OOP...',
                    label: 'Details',
                    type: 'textarea',
                    rules: { required: false, max: 2000 },
                },
            },
        ],
    },
    skills: {
        title: 'Skills',
        description: 'Your skills.',
        actions: { add: true, remove: true },
        fields: [
            {
                skill: {
                    placeholder: 'e.g., Vue.js, Laravel, Teamwork',
                    label: '',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
            },
        ],
    },
    achievements: {
        title: 'Achievements',
        description: 'A list of your notable achievements.',
        actions: { add: true, remove: true },
        fields: [
            {
                achievement: {
                    placeholder: 'Enter each achievement on a new line.',
                    label: '',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
            },
        ],
    },
    projects: {
        title: 'Projects',
        description: 'A list of your projects.',
        actions: { add: true, remove: true },
        fields: [
            {
                project: {
                    placeholder: 'Enter each project on a new line.',
                    label: '',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
            },
        ],
    },
    hobbies: {
        title: 'Hobbies',
        description: 'Your interests and hobbies.',
        actions: { add: true, remove: true },
        fields: [
            {
                hobby: {
                    placeholder: 'e.g., Fitness, Travel, Gaming',
                    label: '',
                    type: 'text',
                    rules: { required: false, min: 2, max: 255 },
                },
            },
        ],
    },
};