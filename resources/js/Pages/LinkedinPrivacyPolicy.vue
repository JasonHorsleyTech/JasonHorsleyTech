<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Resume from "@/Singletons/Resume.vue";
import SourceCodeLinkFooter from "@/Layouts/SourceCodeLinkFooter.vue";
import MarkdownIt from "markdown-it";
import "@/../scss/MarkdownItStyleOverrides.scss";

// import.meta has to be in this file, otherwise I'll always link to the composable :|
import generateGithubLink from "@/Composables/generateGithubLink";
const footerUrl = generateGithubLink(import.meta.url);

const md = new MarkdownIt();
const privacyPolicyHtml = md.render(`
# Privacy Policy for Your Application Name

_Last updated: [11/08/2023]_

This Privacy Policy describes how your personal information is collected, used, and shared when you use **Your Application Name**.

## Personal Information We Collect

When you use our application, we collect the personal information you give us such as your name, profile picture, and email address.

## How We Use Your Personal Information

We use the personal information we collect from you to:
- Authenticate you and provide access to our application.
- Post updates to your LinkedIn profile on your behalf, with your consent.

## Sharing Your Personal Information

We do not share your personal information with any third parties, except as necessary to provide our services or as required by law.

## Your Rights

You have the right to access the personal information we hold about you and to ask that your personal information be corrected, updated, or deleted. If you would like to exercise this right, please contact us through the contact information below.

## Changes

We may update this privacy policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal, or regulatory reasons.

## Contact Us

For more information about our privacy practices, if you have questions, or if you would like to make a complaint, please contact us by e-mail at Jason@JasonHorsley.tech.
`);
</script>

<template>
    <GuestLayout>
        <template #header>
            <Head title="Linkedin auto-poster privacy policy" />
        </template>

        <div
            class="grid place-content-center md:w-[36rem] min-h-screen gap-4 py-4"
        >
            <div
                class="shadow-xl rounded-lg border bg-[#EDF2F7] dark:border-[#4B5563] dark:bg-[#EDF2F7]/20 md:w-[36rem]"
            >
                <div
                    class="prose dark:prose-invert min-h-[32rem] p-4"
                    v-html="privacyPolicyHtml"
                ></div>
            </div>
        </div>

        <template #footer>
            <div class="md:w-[36rem] p-4">
                <SourceCodeLinkFooter :url="footerUrl" />
            </div>
        </template>
    </GuestLayout>
</template>
