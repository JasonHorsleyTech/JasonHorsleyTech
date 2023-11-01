const repoUrl = `https://github.com/JasonHorsleyTech/JasonHorsleyTech/blob/master/resources/js` as const;

const generateGithubLink = (metaUrl: string, folder: string = '/Pages'): string => {
    const componentPath = metaUrl.split('/');
    const componentName = componentPath[componentPath.length - 1];
    return `${repoUrl}/${folder}/${componentName}`;
}

export default generateGithubLink;
