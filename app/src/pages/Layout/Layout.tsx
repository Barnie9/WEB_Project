import { Outlet } from 'react-router-dom';
import LayoutCSS from './Layout.module.css';
import Sidebar from '../../components/Sidebar/Sidebar';

const Layout = () => {
    return (
        <div className={LayoutCSS.page}>
            <div className={LayoutCSS.sidebar}>
                <Sidebar />
            </div>
            <div className={LayoutCSS.content}>
                <Outlet />
            </div>
        </div>
    )
}

export default Layout;