import './bootstrap';
import { createRoot } from 'react-dom/client';
import NewArrivals from "./components/NewArrivals";


const root = createRoot(document.getElementById('root'));
root.render(<NewArrivals />);
