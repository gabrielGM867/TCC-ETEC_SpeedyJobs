wHolder extends RecyclerView.ViewHolder implements View.OnClickListener {

        public interface OnItemClickListener {
            void onItemClick(ViewHolder viewHolder);
        }

        private final Checkable mWidgetView;
        private final TextView mTitleView;
        private final ViewGroup mContainer;
        private final OnItemClickListener mListener;

        public ViewHolder(@NonNull View view, @NonNull OnItemClickListener listener) {
            super(view);
            mWidgetView = (Checkable) view.findViewById(R.id.button);
            mContainer = (ViewGroup) view.findViewById(R.id.container);
            mTitleView = (TextView) view.findViewById(android.R.id.title);
            mContainer.setOnClickListener(this);
            mListener = listener;
        }

        public Checkable getWidgetView() {
            return mWidgetView;
        }

        public TextView getTitleView() {
            return mTitleView;
        }

        public ViewGroup getContainer() {
            return mContainer;
        }

        @Override
        public void onClick(View v) {
            mListener.onItemClick(this);
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         