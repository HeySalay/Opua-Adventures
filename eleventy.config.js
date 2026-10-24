export default function (eleventyConfig) {
  eleventyConfig.addPassthroughCopy({ "src/images": "images" });
  eleventyConfig.addPassthroughCopy({ "src/blog-images": "blog-images" });
  eleventyConfig.addPassthroughCopy({ "src/fonts": "fonts" });
  eleventyConfig.addPassthroughCopy({ "src/css": "css" });
  eleventyConfig.addPassthroughCopy({ "src/js": "js" });
  eleventyConfig.addPassthroughCopy({ "src/_redirects": "_redirects" });
  eleventyConfig.addPassthroughCopy({ "src/robots.txt": "robots.txt" });
  eleventyConfig.addPassthroughCopy({ "src/sitemap.xml": "sitemap.xml" });
  eleventyConfig.addPassthroughCopy({ "src/site.webmanifest": "site.webmanifest" });
  eleventyConfig.addPassthroughCopy({ "src/favicon.ico": "favicon.ico" });

  eleventyConfig.addFilter("readableDate", (date) =>
    date.toLocaleDateString("en-US", {
      year: "numeric",
      month: "long",
      day: "numeric",
      timeZone: "UTC"
    })
  );
}

export const config = {
  dir: {
    input: "src",
    output: "_site",
    layouts: "_layouts" // relative to src //
  },
};