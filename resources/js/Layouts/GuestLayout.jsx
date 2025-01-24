import { Link } from '@inertiajs/react';

export default function Guest({ children }) {
    return (
        <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div className="p-1 bg-white rounded-lg shadow-xl hover:shadow-2xl transition-shadow duration-300 border-2 border-green-500 inline-block">
                <Link href="/">
                    <img
                        src="/minecraft-1-logo-pack/creeper_logo.png"
                        alt="Creeper Logo"
                        className="w-20 h-20 transform hover:scale-110 transition-transform duration-300"
                    />
                </Link>
            </div>

            <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {children}
            </div>
        </div>
    );
}
