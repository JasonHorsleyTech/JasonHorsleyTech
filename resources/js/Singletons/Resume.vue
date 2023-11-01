<script lang="ts" setup>
import axios from "axios";
import "@/../scss/ResumeMarkdownItStyleOverrides.scss";
import MarkdownIt from "markdown-it";
import { ref } from "vue";
import { onMounted } from "vue";
import Loader from "@/Components/Loader.vue";
import { computed } from "vue";
import { watch } from "vue";

const md = new MarkdownIt();

const resume = ref<{
    id: number;
    name: string;
    content: string;
} | null>(null);
const resumes = ref<{ id: number; name: string }[]>([]);
const company_name = ref<string | null>(null);

interface ResumeControllerIndexResponse {
    data: {
        resumes: { id: number; name: string }[];
    };
}

interface ResumeControllerShowResponse {
    data: {
        id: number;
        name: string;
        content: string;
    };
}

interface ResumeControllerInvokeResponse {
    data: {
        resume: {
            id: number;
            name: string;
            content: string;
        };
        company_name: null | string;
    };
}

onMounted(async () => {
    const resumeIndexResponse = (await axios.get(
        "/api/professional/resumes"
    )) as ResumeControllerIndexResponse;
    resumes.value = resumeIndexResponse.data.resumes;

    const { data } = (await axios.get(
        "/api/professional/resume"
    )) as ResumeControllerInvokeResponse;
    resume.value = data.resume;
    selectedResumeId.value = data.resume.id;

    company_name.value = data.company_name;
});

const htmlContent = computed(() => {
    if (resume.value === null) return null;

    return md.render(resume.value.content);
});

const selectedResumeId = ref<number | null>(null);
watch(selectedResumeId, (resume_id) => {
    if (resume_id === null) return;
    if (resume_id === resume.value?.id) return;

    fetchResume(resume_id);
});
const fetchResume = async (resume_id: number) => {
    resume.value = null;

    const { data } = (await axios.get(
        `/api/professional/resumes/${resume_id}`
    )) as ResumeControllerShowResponse;

    resume.value = data;
};
</script>

<template>
    <div>
        <div
            class="shadow-xl rounded-lg border bg-[#EDF2F7] dark:border-[#4B5563] dark:bg-[#EDF2F7]/20 md:w-[36rem]"
        >
            <Loader v-if="!htmlContent" />
            <div
                v-else
                class="prose dark:prose-invert min-h-[32rem] p-4"
                v-html="htmlContent"
            ></div>
        </div>

        <div class="flex flex-row justify-end py-4">
            <div v-if="company_name">
                <span>Pssst! You're {{ company_name }} right?</span>
                <span>
                    This is the resume I sent you, but I'll let you peak at the
                    others too.
                </span>
            </div>
            <select v-model="selectedResumeId">
                <option value="null" disabled selected>
                    Select a different resume
                </option>
                <option
                    v-for="resume in resumes"
                    :key="resume.id"
                    :value="resume.id"
                >
                    {{ resume.name }}
                </option>
            </select>
        </div>
    </div>
</template>
