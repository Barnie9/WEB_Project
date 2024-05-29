import PageNotFoundCSS from './PageNotFound.module.css';

const PageNotFound = () => {
    return (
        <div className={PageNotFoundCSS.page}>
            <div className={PageNotFoundCSS.title}>404</div>
            <div className={PageNotFoundCSS.subtitle}>Page Not Found</div>
        </div>
    );
};

export default PageNotFound;