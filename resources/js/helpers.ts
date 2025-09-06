export const schema = {
    personalInfo: {
        title: 'Personal Information',
        description: 'Your personal contact details.',
        actions: { add: false, remove: false },
        fields: [
            {
                firstName: {
                    placeholder: 'e.g., John',
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                lastName: {
                    placeholder: 'e.g., Snow',
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                email: {
                    placeholder: 'e.g., your@email.com',
                    type: 'email',
                    value: null,
                    rules: { required: true, email: true },
                },
                mobile: {
                    placeholder: 'e.g., +49 123 456789',
                    type: 'string',
                    value: null,
                    rules: { required: false, min: 10, max: 20 },
                },
                website: {
                    placeholder: 'e.g., www.your-portfolio.com',
                    class: 'sm:col-span-2',
                    type: 'url',
                    value: null,
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
                    class: 'sm:col-span-2',
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 5, max: 255 },
                },
                city: {
                    placeholder: 'e.g., Oldenburg',
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                state: {
                    placeholder: 'e.g., Lower Saxony',
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                zipCode: {
                    placeholder: 'e.g., 26121',
                    type: 'string',
                    value: null,
                    rules: { required: true, numeric: true, min: 4, max: 10 },
                },
                country: {
                    placeholder: 'e.g., Germany',
                    type: 'string',
                    value: null,
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
                    type: 'url',
                    value: null,
                    rules: { required: false, url: true },
                },
                github: {
                    placeholder: 'URL of your GitHub profile',
                    type: 'url',
                    value: null,
                    rules: { required: false, url: true },
                },
                twitter: {
                    placeholder: 'URL of your Twitter profile',
                    type: 'url',
                    value: null,
                    rules: { required: false, url: true },
                },
                instagram: {
                    placeholder: 'URL of your Instagram profile',
                    type: 'url',
                    value: null,
                    rules: { required: false, url: true },
                },
                other: {
                    placeholder: 'URL of a profile',
                    type: 'url',
                    value: null,
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
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                company: {
                    placeholder: 'e.g., Tech Solutions Inc.',
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                startDate: {
                    placeholder: 'e.g., Oct 2022',
                    type: 'date',
                    value: null,
                    rules: { required: true, date: true },
                },
                endDate: {
                    placeholder: 'e.g., Sep 2023 or Present',
                    type: 'date',
                    value: null,
                    rules: { required: false, date: true },
                },
                description: {
                    component: 'textarea',
                    placeholder: 'Enter each responsibility on a new line.',
                    class: 'sm:col-span-2',
                    type: 'string',
                    value: null,
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
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                institution: {
                    placeholder: 'e.g., University of Oldenburg',
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
                },
                graduationDate: {
                    placeholder: 'e.g., Sep 2022',
                    type: 'date',
                    value: null,
                    rules: { required: true, date: true },
                },
                details: {
                    component: 'textarea',
                    placeholder: 'e.g., Grade: 1.8\nFocus on OOP...',
                    class: 'sm:col-span-2',
                    type: 'string',
                    value: null,
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
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
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
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
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
                    type: 'string',
                    value: null,
                    rules: { required: true, min: 2, max: 255 },
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
                    name: 'hobby',
                    label: 'Hobby',
                    placeholder: 'e.g., Fitness, Travel, Gaming',
                    type: 'string',
                    value: null,
                    rules: { required: false, min: 2, max: 255 },
                },
            },
        ],
    },
};

/**
 * Fills a JSON schema with data from a backend source.
 *
 * @param {object} data - The data object received from the backend.
 * @returns {object} The populated JSON schema.
 */
export function schemaMigration(data: any) {
    const populatedSchema = JSON.parse(JSON.stringify(schema));

    for (const sectionKey in data) {
        if (Object.prototype.hasOwnProperty.call(data, sectionKey) && populatedSchema[sectionKey]) {
            const sectionDataItems = data[sectionKey];
            const sectionSchema = populatedSchema[sectionKey];

            const fieldGroupTemplate = sectionSchema.fields[0];

            if (!sectionDataItems || sectionDataItems.length === 0) {
                continue;
            }

            const newFieldGroups = sectionDataItems.map((dataItem) => {
                const newFieldGroup = JSON.parse(JSON.stringify(fieldGroupTemplate));

                for (const fieldKey in dataItem) {
                    if (Object.prototype.hasOwnProperty.call(dataItem, fieldKey) && newFieldGroup[fieldKey]) {
                        newFieldGroup[fieldKey].value = dataItem[fieldKey];
                    }
                }
                return newFieldGroup;
            });

            sectionSchema.fields = newFieldGroups;
        }
    }

    return populatedSchema;
}
